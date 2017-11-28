<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Page_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function addVisitor($data)
    {
        $visitor = $this->db->get_where('visitors', array('ip_address' => $data['ip_address']))->row_array();
        
        if($visitor)
        {
            $visitor_data = array(
                'last_visit_at'    => date('Y-m-d h:i:s')
                );
            $this->db->update('visitors', $visitor_data);
            $visitor_id = $visitor['id'];
        }
        else
        {
            $visitor_data = array(
                'ip_address'        => $data['ip_address'],
                'first_visit_at'    => date('Y-m-d h:i:s')
                );
            $this->db->insert('visitors', $visitor_data);
            $visitor_id = $this->db->insert_id();
        }

        $visitor_url = array(
            'ip_id'     => $visitor_id,
            'url'       => $data['url'],
            'visit_at'  => date('Y-m-d H:i:s')
            );
        $this->db->insert('visitor_has_views', $visitor_url);
        return true;
    }


    function likes($data)
    {
        $like = $this->db->get_where('ipaddress_likes_map', array('news_id' => $data['id'], 'ip_address'   => $_SERVER['REMOTE_ADDR']))->row_array();
        if(isset($like) && !empty($like))
        {
            $response['rc'] = FALSE;
        }
        else
        {
            $ip_data = array(
                'ip_address'   => $_SERVER['REMOTE_ADDR'],
                'news_id'      => $data['id'],
                'status'       => LIKE
                );
            $result = $this->db->insert('ipaddress_likes_map', $ip_data);
            if(!empty($result)) {
                $query ="UPDATE news SET likes = likes + 1 WHERE id='" . $data["id"] . "'";
                $result = $this->db->query($query);              
            }           
            
            $response['rc'] = TRUE;
        }
        return $response;
    }

    function unlikes($data)
    {
        $unlike = $this->db->get_where('ipaddress_likes_map', array('news_id' => $data['id'], 'ip_address'   => $_SERVER['REMOTE_ADDR']))->row_array();
        if(isset($unlike) && !empty($unlike))
        {
            $response['rc'] = FALSE;
        }
        else
        {
            $ip_data = array(
                'ip_address'   => $_SERVER['REMOTE_ADDR'],
                'news_id'      => $data['id'],
                'status'       => UNLIKE
                );
            $result = $this->db->insert('ipaddress_likes_map', $ip_data);
            if(!empty($result)) {
                $query ="UPDATE news SET unlikes = unlikes + 1 WHERE id='" . $data["id"] . "'";
                $result = $this->db->query($query);
            }
            
            $response['rc'] = TRUE;
        }
        return $response;
    }

    function add_comment($comment)
    {
        $this->db->insert('news_has_comments', $comment);
        $comment_id = $this->db->insert_id();
        return $comment_id;
    }
    
    function add_message($message)
    {
        $this->db->insert('contact_message', $message);
        $message_id = $this->db->insert_id();
        return $message_id;
    }

    function get_like_count($news_id)
    {
        $query ="SELECT count(*) as count, status FROM ipaddress_likes_map WHERE news_id = '" . $news_id . "' and ip_address = '" . $_SERVER['REMOTE_ADDR'] . "'";
        $result = $this->db->query($query)->row_array();
        return $result;
    }

    function register($data,$files)
    {
        $this->db->insert('users',$data);
        $data['user_id'] = $this->db->insert_id();
        if(!empty($files))
        {
            $dir = FCPATH.'resources/img/user_photos';
            if(!is_dir($dir))
            {
                @mkdir($dir, 0777, TRUE);
            }

            $dir = FCPATH.'resources/img/user_photos/';
            $ext = ".".pathinfo($files['photo']['name'], PATHINFO_EXTENSION);
            $hash = md5(rand(00000000,99999999).time()).$ext;

            if(move_uploaded_file($files['photo']['tmp_name'], $dir.$hash))
            {
                $data['photo'] = 'thumb_'.$hash;
                
                list($width, $height, $type, $attr) = getimagesize($dir.$hash);
                // calculate the image dimensions ratio
                $ratio = $width / $height;
                $ratio = number_format($ratio, 1, '.', '');
                if($ratio == '1')
                {
                    // resize the image to w:303, h:227
                    resize_image('force', $dir.$hash,$dir.'thumb_'.$hash ,300, 300);
                }
                else
                {
                    // crop/resize to an image with 3:2 ratio
                    resize_image('crop', $dir.$hash,$dir.'thumb_'.$hash ,300,300);
                } 
                unlink($dir.$hash);
                
                $this->db->update('users', array('photo' => $data['photo']),array('id' => $data['user_id']));
            }
        }
        
        $result = $this->login($data['email'],$data['password']);
        if($result)
        {
            $response['rc'] = TRUE;
            $response['msg'] = 'You have successfully registered with us! <a href="">Click here</a> to get our offers';
        }
        return $response;
    }

    function update_profile($user_id, $data, $files)
    {
        $user_data = $this->db->get_where('users', array('id' => $user_id))->row_array();
        $this->db->where('id', $user_id);
        $this->db->update('users',$data);
        
        if(!empty($files))
        {
            $dir = FCPATH.'resources/img/user_photos';
            if(!is_dir($dir))
            {
                @mkdir($dir, 0777, TRUE);
            }

            $dir = FCPATH.'resources/img/user_photos/';
            $ext = ".".pathinfo($files['photo']['name'], PATHINFO_EXTENSION);
            $hash = md5(rand(00000000,99999999).time()).$ext;

            if(move_uploaded_file($files['photo']['tmp_name'], $dir.$hash))
            {
                if(!empty($user_data['photo']))
                {
                    unlink($dir.$user_data['photo']);
                }
                $data['photo'] = 'thumb_'.$hash;
                
                list($width, $height, $type, $attr) = getimagesize($dir.$hash);
                // calculate the image dimensions ratio
                $ratio = $width / $height;
                $ratio = number_format($ratio, 1, '.', '');
                if($ratio == '1')
                {
                    // resize the image to w:303, h:227
                    resize_image('force', $dir.$hash,$dir.'thumb_'.$hash ,300, 300);
                }
                else
                {
                    // crop/resize to an image with 3:2 ratio
                    resize_image('crop', $dir.$hash,$dir.'thumb_'.$hash ,300,300);
                } 
                unlink($dir.$hash);
                $this->db->update('users', array('photo' => $data['photo']),array('id' => $user_id));
            }
        }
        
        $result = $this->login($user_data['email'],$user_data['password']);
        if($result)
        {
            $response['rc'] = TRUE;
            $response['msg'] = 'Profile has been updated successfully! <a href="'.base_url().'posts" style="float:none;">Click here</a> to post Photo / Video';
        }
        return $response;
    }

    function login($email,$password)
    {
        $result=$this->db->get_where('users',array('email' => $email,'password' =>$password ))->row_array();
        
        if(isset($result['id']))
        {
            $this->session->set_userdata('user_id',$result['id']);
            $this->session->set_userdata('email',$result['email']);
            $this->session->set_userdata('username',$result['firstname'].' '.$result['lastname']);
            $this->input->set_cookie('user_id',$result['id'],'2592000');
            
            return TRUE;
        }
        else
            return FALSE;
    }

    function add_post($data,$files)
    {
        $this->db->insert('user_has_posts',$data);
        $data['post_id'] = $this->db->insert_id();
        if(!empty($files['photo']) && !empty($files['photo']['name']) && ($files['photo']['error'] == 0))
        {
            $extension = ".".pathinfo($files['photo']['name'], PATHINFO_EXTENSION);
            $ext = strtolower($extension);
            if($ext == '.jpg' || $ext == '.jpeg' || $ext == '.gif' || $ext == '.png')
            {
                $data['post_type'] = IMAGE;
                $dir = FCPATH.'resources/posts/img/'.$this->session->userdata('user_id');
                if(!is_dir($dir))
                {
                    @mkdir($dir, 0777, TRUE);
                }

                $dir = FCPATH.'resources/posts/img/'.$this->session->userdata('user_id').'/';
            }
            elseif($ext == '.mp4')
            {
                $data['post_type'] = UPLOADED_VIDEO;
                $dir = FCPATH.'resources/posts/video/'.$this->session->userdata('user_id');
                if(!is_dir($dir))
                {
                    @mkdir($dir, 0777, TRUE);
                }

                $dir = FCPATH.'resources/posts/video/'.$this->session->userdata('user_id').'/';
            }
            $hash = md5(rand(00000000,99999999).time()).$ext;
             
            if(move_uploaded_file($files['photo']['tmp_name'], $dir.$hash))
            {
                 $data['post'] = $hash;
                 
                 $this->db->update('user_has_posts', array('post' => $data['post'], 'post_type' => $data['post_type']),array('id' => $data['post_id']));
            }
        }
        
        if($data['post_id'])
        {
            $response['rc'] = TRUE;
            $response['msg'] = 'You have successfully registered with us!';
        }
        return $response;
    }

    function get_all_posts()
    {
        return $this->db->query('SELECT 
                                    *,
                                    user_has_posts.id as post_id 
                                FROM
                                    user_has_posts,
                                    users
                                WHERE
                                    user_has_posts.user_id = users.id AND
                                    user_has_posts.post_type != 0
                                ORDER BY
                                    user_has_posts.id DESC
                                LIMIT '.POST_LIMIT)->result_array();
    }

    function get_all_posts_by_ajax($offset, $filter, $sort)
    {
        if(isset($filter) && !empty($filter))
        {
            if($filter == IMAGE)
            {
                $filter_by = 'AND user_has_posts.post_type = '.$filter; 
            }
            elseif($filter == UPLOADED_VIDEO)
            {
                $filter_by = 'AND user_has_posts.post_type = '.$filter; 
            }
            elseif($filter == MY_POST)
            {
                $filter_by = 'AND user_has_posts.user_id = '.$this->session->userdata('user_id'); 
            }
            else
            {
                $filter_by = '';
            }
        }
        else
        {
            $filter_by = '';
        }
        
        if(isset($sort) && !empty($sort))
        {
            if($sort == VIEWS)
            {
                $order_by = 'ORDER BY user_has_posts.views DESC, user_has_posts.id DESC'; 
            }
            elseif($sort == RATINGS)
            {
                $order_by = 'ORDER BY user_has_posts.ratings DESC, user_has_posts.id DESC'; 
            }
            elseif($sort == COMMENTS)
            {
                $order_by = 'ORDER BY user_has_posts.comments DESC, user_has_posts.id DESC'; 
            }
            elseif($sort == RECENT)
            {
                $order_by = 'ORDER BY user_has_posts.id DESC'; 
            }
            else
            {
                $order_by = 'ORDER BY user_has_posts.id DESC';
            }
        }
        else
        {
            $order_by = 'ORDER BY user_has_posts.id DESC';
        }

        if(isset($offset) && !empty($offset))
        {
            $limit = " LIMIT ".$offset.",".POST_LIMIT;
        }
        else
        {
            $offset = 0;
            $limit = " LIMIT ".$offset.",".POST_LIMIT;
        }
        
        return $this->db->query('SELECT 
                                    *,
                                    user_has_posts.id as post_id 
                                FROM
                                    user_has_posts,
                                    users
                                WHERE
                                    user_has_posts.user_id = users.id AND
                                    user_has_posts.post_type != 0
                                    '.$filter_by.' '.$order_by.' '.$limit)->result_array();
    }

    function get_post_by_user_id($id)
    {
        return $this->db->query('SELECT 
                                    * ,
                                    user_has_posts.id as post_id
                                FROM
                                    user_has_posts,
                                    users
                                WHERE
                                    user_has_posts.user_id = users.id
                                    AND user_has_posts.post_type != 0
                                    AND users.id = '.$id.'
                                ORDER BY user_has_posts.id DESC')->result_array();
    }
    
    function get_most_views()
    {
        return $this->db->query('SELECT 
                                    * 
                                FROM
                                    user_has_posts,
                                    users
                                WHERE
                                    user_has_posts.user_id = users.id
                                    AND user_has_posts.post_type != 0
                                ORDER BY
                                    user_has_posts.views DESC
                                LIMIT 4')->result_array();
    }

    function update_views($post_id)
    {
        $post = $this->db->get_where('user_has_posts',array('id' => $post_id))->row_array();
        $post['views']++;
        
        $this->db->where('id',$post_id);
        return $this->db->update('user_has_posts',array('views' => $post['views']));
    }

    function update_ratings($post, $user_id)
    {
        $rating = $this->db->get_where('post_has_ratings',array('user_id' => $user_id, 'post_id' => $post['post_id']))->row_array();
        if(isset($rating) && !empty($rating))
        {
            $this->db->where('user_id', $user_id);
            $this->db->where('post_id', $post['post_id']);
            $this->db->update('post_has_ratings', array('rating' => $post['ratings']));
        }
        else
        {
            $this->db->insert('post_has_ratings', array('user_id' => $user_id, 'post_id' => $post['post_id'], 'rating' => $post['ratings']));
        }
        $result = $this->db->query("SELECT 
                            SUM(rating) as sum,
                            count(user_id) as count
                        FROM
                            post_has_ratings
                        WHERE
                            post_id = ".$post['post_id'])->row_array();
        $result['rating'] = $result['sum']/$result['count'];
        $this->db->where('id', $post['post_id']);
        return $this->db->update('user_has_posts',array('ratings' => round($result['rating'], 1)));
    }

    function update_comments($post_id)
    {
        $result = $this->db->get_where('post_has_comments', array('post_id' => $post_id))->result_array();
        $this->db->where('id',$post_id);
        return $this->db->update('user_has_posts', array('comments' => count($result)));
    }

    function insert_email_data($email_data)
    {
        $this->db->insert('emails', $email_data);
        return $this->db->insert_id();
    }
    
    function get_comments_by_post_id($post_id)
    {
        return $this->db->query('SELECT
                                    *
                                FROM
                                    users,
                                    post_has_comments
                                WHERE 
                                    post_has_comments.post_id = '.$post_id.'
                                    AND users.id = post_has_comments.user_id
                                ORDER BY post_has_comments.id DESC')->result_array();
    }

    function get_rating_by_post_id($post_id, $user_id)
    {
        return $this->db->get_where('post_has_ratings', array('post_id' => $post_id, 'user_id' => $user_id))->row_array();
    }

    function get_post_by_id($post_id)
    {
        return $this->db->get_where('user_has_posts', array('id' => $post_id))->row_array();
    }

    function check_email($email)
    {
        $this->db->select('email');
        $query = $this->db->get_where('users',array('email' => $email));
        return $query->row_array();
    }
      
    function get_password_key($email)
    {
        $hash = md5(microtime().rand());
        $this->db->where('email',$email);
        $this->db->update('users',array('password_key'=>$hash));
        $result = $this->db->get_where('users', array('email' => $email))->row_array();
        return $result;
    }

    function get_user_by_id($user_id)
    {
        return $this->db->query(
                        'SELECT
                            *
                        FROM
                            users
                        WHERE
                            id = '.$user_id)->row_array();
    }

    function check_password_key($key)
    {
        $this->db->where('password_key',$key);
        $data = $this->db->get('users')->row_array();
        if($data)
        {
            $response['rc'] = TRUE;
            $response['data'] = $data;
            $response['msg'] = "Invalid key";
        }
        
        return $response;
    }
        
    function reset_password($key, $new_password)
    {
        $user = $this->db->get_where('users', array('password_key'=> $key))->row_array();
        $this->db->where('password_key', $key);
        $result = $this->db->update('users', array('password' => $new_password, 'password_key'=>''));
        if($result)
        {
            $this->session->set_userdata('user_id',$user['id']);
            $this->session->set_userdata('email',$user['email']);
            
            $response['rc'] = TRUE;
            $response['msg'] = 'Password has been changed successfully!';
        }
        else
        {
            $response['rc'] = FALSE;
            $response['msg'] = 'Unable to change password!';
        }
        return $response;
    }
     
    function change_password($user_id, $new_password)
    {
        $this->db->where('id', $user_id);
        $result = $this->db->update('users', array('password' => $new_password));
        if($result)
        {
            $response['rc'] = TRUE;
            $response['msg'] = 'Password has been changed successfully!';
        }
        else
        {
            $response['rc'] = FALSE;
            $response['msg'] = 'Unable to change password!';
        }
        return $response;
    }

    function update_video_poster($post_id, $poster)
    {
        $this->db->where('id', $post_id);
        return $this->db->update('user_has_posts', array('poster' => $poster));
    }

    function update_all_views()
    {
        return $this->db->query('UPDATE
                                    user_has_posts
                                SET 
                                    views = views+1');
    }
          
}
?>
