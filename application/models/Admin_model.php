<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function login($username,$password)
    {
        $result=$this->db->get_where('admin',array('username' => $username,'password' =>$password ))->row_array();
        
        if(isset($result['id']))
        {
            $this->session->set_userdata('admin_id',$result['id']);
            $this->session->set_userdata('username',$result['username']);
            
            return TRUE;
        }
        else
            return FALSE;
    }
    
    
     /*
     * change password
     */
    function change_password($id, $params)
    {
        $this->db->where('id',$id);
        $response = $this->db->update('admin',$params);
    }

     /*
     * change admin name
     */
    function update_admin($id, $params)
    {
        $this->db->where('id',$id);
        $response = $this->db->update('admin',$params);
    }

     /*
     * update profile picture
     */
    function update_profile_picture($id, $files)
    {
        $admin = $this->get_admin_details($id);
        if(!empty($files))
        {
            $dir = FCPATH.'resources/dp';
            if(!is_dir($dir))
            {
                @mkdir($dir, 0777, TRUE);
            }
            $dir = FCPATH.'resources/dp/';
            $ext = ".".pathinfo($files['picture']['name'], PATHINFO_EXTENSION);
            $hash = md5(rand(00000000,99999999).time()).$ext;
           
            if(move_uploaded_file($files['picture']['tmp_name'], $dir.$hash))
            {
                if(!empty($admin['picture']))
                {
                    unlink($dir.$admin['picture']);
                }
                $thumb_width = 70;
                $thumb_height = 90;
                $thumb_source_path = $dir.$hash;
                $thumb_target_path = $dir.$hash;
                make_thumb($thumb_source_path, $thumb_target_path, $thumb_width, $thumb_height);
                
                //resize($width, $target_path, $source_path);
                $data['picture'] = $hash;
                 //pr($data);exit;
                $this->db->update('admin', array('picture' => $data['picture']),  array('id' => $id));
            }
        }

        /*if($response)
        {
            return "admin updated successfully";
        }
        else
        {
            return "Error occuring while updating admin";
        }*/
    }
    
    function get_admin_details($id)
    {
        return $this->db->get_where('admin',array('id'=>$id))->row_array();
    }

    function comment_count()
    {
        $comments = $this->db->query('
            SELECT
                count(*) as count
            FROM
                news_has_comments
            ORDER BY added_on DESC
            ')->row_array();
        
        return $comments['count'];
    }

    function get_all_comments($params)
    {
        if(isset($params['limit']) && !empty($params['limit']))
        {
            $limit_condition = 'LIMIT '.$params['limit'].', '.$params['offset'];
        }
        else
        {
            $limit_condition = 'LIMIT 0, '.$params['offset'];
        }
        $comments = $this->db->query('
            SELECT
                news_has_comments.*, news.title as news
            FROM
                news_has_comments
            LEFT JOIN
                news
            ON news_has_comments.news_id = news.id
            ORDER BY news_has_comments.added_on DESC
            '.$limit_condition.' 
            ')->result_array();
        if($comments)
        {
            $response['rc'] = TRUE;
            $response['data'] = $comments;
        }
        else
        {
            $response['rc'] = FALSE;
            $response['data'] = '';
        }
        return $response;
    }
    
    function delete_post($id)
    {
        
        $post = $this->db->get_where('user_has_posts',array('id'=>$id))->row_array();
        if(!empty($post['post']))
        {
            if($post['post_type'] == IMAGE)
            {
                $dir = FCPATH.'resources/posts/img/'.$post['user_id'].'/'.$post['post'];
                unlink($dir);
                rmdir($dir);
            }
            elseif($post['post_type'] == UPLOADED_VIDEO)
            {
                $dir = FCPATH.'resources/posts/video/'.$post['user_id'].'/'.$post['post'];
                unlink($dir);
                rmdir($dir);
            }
        }
        return $this->db->delete('user_has_posts',array('id'=>$id));
       
    }
    
}
?>
