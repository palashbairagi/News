<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class News_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_contact()
    {
        return $this->db->get('contact')->result_array();
    }

    function delete_contact($id)
    {
        return $this->db->delete('contact',array('id'=>$id));
    }

    function update_contact($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('contact', $data);  
    }

    function add_contact($data)
    {
        return $this->db->insert('contact', $data);  
    }
     
    function get_messages()
    {
    	$this->db->order_by("date_time", "desc");
	$query = $this->db->get('contact_message'); 
	return $query->result_array();
    }
    
    function delete_message($id)
    {
        return $this->db->delete('contact_message',array('id'=>$id));
    }

    function update_message_status($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('contact_message', $data);  
    }
    
    function get_rashifal()
    {
        return $this->db->get('rashi')->result_array();
    }

    function update_rashifal($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('rashi', $data);  
    }

    function get_headlines()
    {
        return $this->db->get('headlines')->result_array();
    }

    function delete_headlines($id)
    {
        return $this->db->delete('headlines',array('id'=>$id));
    }

    function update_headlines($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('headlines', $data);  
    }

    function add_headlines($data)
    {
        return $this->db->insert('headlines', $data);  
    }
       
    function get_news($params)
    {
        $category_condition = '';
        if(isset($params['category_id']) && !empty($params['category_id']))
        {
            $category_condition = 'AND category_id = '.$params['category_id'];
        }

        $home_page_condition = '';
        if(isset($params['is_home_page']) && !empty($params['is_home_page']) && $params['is_home_page'] == 1)
        {
            $home_page_condition = 'AND (is_main_news = 1 OR is_other_news = 1)';
        }

        $popular_news_condition = '';
        if(isset($params['is_popular_news']) && !empty($params['is_popular_news']) && $params['is_popular_news'] == 1)
        {
            $popular_news_condition = 'AND is_popular_news = 1';
        }

        $limit_condition = '';
        if(isset($params['limit']) && !empty($params['limit']))
        {
            $limit_condition = 'LIMIT '.$params['limit'].', '.$params['offset'];
        }
        elseif(isset($params['offset']) && !empty($params['offset']))
        {
            $limit_condition = 'LIMIT 0, '.$params['offset'];
        }

        $news = $this->db->query('
            SELECT
                news.*, 
                meta_categories.category_name,
                meta_categories.category_url
            FROM
                news
            LEFT JOIN
                meta_categories
            ON news.category_id = meta_categories.id
            WHERE 
                1 = 1 
                '.$category_condition.' 
                '.$home_page_condition.'
                '.$popular_news_condition.'
            ORDER BY sort_order, added_on DESC
            '.$limit_condition.'
            ')->result_array();
// pr($this->db->last_query());exit;
        return $news;
    }

    function news_count($params)
    {
        $category_condition = '';
        if(isset($params['category_id']) && !empty($params['category_id']))
        {
            $category_condition = 'AND category_id = '.$params['category_id'];
        }

        $home_page_condition = '';
        if(isset($params['is_home_page']) && !empty($params['is_home_page']) && $params['is_home_page'] == 1)
        {
            $home_page_condition = 'AND (is_main_news = 1 OR is_other_news = 1)';
        }

        $popular_news_condition = '';
        if(isset($params['is_popular_news']) && !empty($params['is_popular_news']) && $params['is_popular_news'] == 1)
        {
            $popular_news_condition = 'AND is_popular_news = 1';
        }

        $news = $this->db->query('
            SELECT
                count(*) as count
            FROM
                news
            LEFT JOIN
                meta_categories
            ON news.category_id = meta_categories.id
            WHERE 
                1 = 1 
                '.$category_condition.' 
                '.$home_page_condition.'
                '.$popular_news_condition.'
            ORDER BY sort_order, added_on DESC
            ')->row_array();

        return $news['count'];
    }

    function get_related_news($news_id, $params)
    {
        $category_condition = '';
        if(isset($params['category_id']) && !empty($params['category_id']))
        {
            $category_condition = 'AND category_id = '.$params['category_id'];
        }

        $news = $this->db->query('
            SELECT * FROM
            (SELECT
                news.*, 
                meta_categories.category_name,
                meta_categories.category_url
            FROM
                news
            LEFT JOIN
                meta_categories
            ON news.category_id = meta_categories.id
            WHERE 
                1 = 1 
                AND news.id != '.$news_id.'
                '.$category_condition.' 
            ORDER BY sort_order, added_on DESC
            LIMIT 10)n ORDER BY RAND() LIMIT 3')->result_array();

        return $news;
    }

    function get_category_by_url($category_url)
    {
        return $this->db->get_where('meta_categories', array('category_url' => $category_url))->row_array();
    }

    function get_news_by_url($url)
    {
        $news = $this->db->query("
            SELECT
                news.*, 
                meta_categories.category_name,
                meta_categories.category_url
            FROM
                news
            LEFT JOIN
                meta_categories
            ON news.category_id = meta_categories.id
            WHERE
                url = '".$url."'")->row_array();
        return $news;
    }

    function add_news($news_data,$files)
    {
        $this->db->insert('news', $news_data);
        $data['news_id'] = $this->db->insert_id();
        if(!empty($files))
        {
            $dir = FCPATH.'resources/img/news_image/'.$data['news_id'];
            if(!is_dir($dir))
            {
                @mkdir($dir, 0777, TRUE);
            }
            $dir = FCPATH.'resources/img/news_image/'.$data['news_id'].'/';
            $ext = ".".pathinfo($files['image']['name'], PATHINFO_EXTENSION);
            $hash = md5(rand(00000000,99999999).time()).$ext;
           
            if(move_uploaded_file($files['image']['tmp_name'], $dir.$hash))
            {
                if($news_data['category_id'] != VIDEO)
                {
                    $width = 710;
                    $height = 532;
                    $source_path = $dir.$hash;
                    $target_path = $dir.$hash;
                    resize_image('crop', $source_path, $target_path, $width, $height);
                    
                    $thumb_width = 90;
                    $thumb_height = 70;
                    $thumb_source_path = $dir.$hash;
                    $thumb_target_path = $dir.'thumb_'.$hash;
                    resize_image('crop', $thumb_source_path, $thumb_target_path, $thumb_width, $thumb_height);
                }
                //resize($width, $target_path, $source_path);
                $data['image'] = $hash;
                 //pr($data);exit;
                $this->db->update('news', array('image' => $data['image']),  array('id' => $data['news_id']));
            }
            
        }
        return $data['news_id'];
    }
    
    function update_news($news_data,$news_id,$files)
    {
        $this->db->where('id', $news_id);
        $this->db->update('news', $news_data);
        $image=$this->db->get_where('news',array('id'=>$news_id))->row_array();
        if($files['image']['tmp_name'])
        {
            
            $dir = FCPATH.'resources/img/news_image/'.$news_id;
            
            if(!is_dir($dir))
            {
                @mkdir($dir, 0777, TRUE);
            }
            $dir = FCPATH.'resources/img/news_image/'.$news_id.'/';
            $ext = ".".pathinfo($files['image']['name'], PATHINFO_EXTENSION);
            $hash = md5(rand(00000000,99999999).time()).$ext;

            if(move_uploaded_file($files['image']['tmp_name'], $dir.$hash))
            {
                if(!empty($image['image']))
                {
                    unlink($dir.'/'.$image['image']);
                }

                if($image['category_id'] != VIDEO)
                {
                    $width = 710;
                    $height = 532;
                    $source_path = $dir.$hash;
                    $target_path = $dir.$hash;
                    resize_image('crop', $source_path, $target_path, $width, $height);
                    
                    $thumb_width = 90;
                    $thumb_height = 70;
                    $thumb_source_path = $dir.$hash;
                    $thumb_target_path = $dir.'thumb_'.$hash;
                    resize_image('crop', $thumb_source_path, $thumb_target_path, $thumb_width, $thumb_height);
                }
                $data['image'] = $hash;
                 //pr($data);exit;
                $this->db->update('news', array('image' => $data['image']),  array('id' => $news_id));
            }
        }
         return true;
    }
    
    function get_all_news()
    {
        return $this->db->get('news')->result_array();
    }
    
    function get_all_active_news()
    {
        return $this->db->get_where('news',array('is_active' => 1))->result_array();
    }
    
    function get_news_by_id($id)
    {
    	$news = $this->db->get_where('news',array('id'=>$id))->row_array();
    	return $news;
    }
    
    function delete_news($id)
    {
        
        $news = $this->db->get_where('news',array('id'=>$id))->row_array();
        if(!empty($news['image']))
        {
            $dir = FCPATH.'resources/img/news_image/'.$news['id'].'/';
            if(unlink($dir.$news['image']) && unlink($dir.'thumb_'.$news['image']))
            {
            rmdir($dir);
            }
        }
        $this->db->delete('news',array('id'=>$id));
        return $news;
    }

    function update_main_news($news_id, $category_id, $data)
    {
        $this->db->where('category_id',$category_id);
        $this->db->update('news', array('is_main_news' => 0));

        $this->db->where('id',$news_id);
        $this->db->update('news', $data);
        return TRUE;
    }

    function update_other_news($news_id, $category_id, $data)
    {
        $news = $this->db->get_where('news', array('category_id' => $category_id, 'is_other_news' => 1))->result_array();
        if(count($news) < OTHER_NEWS && $data['is_checked'] == 1)
        {
            $this->db->where('id',$news_id);
            $this->db->update('news', array('is_other_news' => 1));
            $response['rc'] = TRUE;
        }
        elseif($data['is_checked'] == 0)
        {
            $this->db->where('id',$news_id);
            $this->db->update('news', array('is_other_news' => 0));
            $response['rc'] = TRUE;
        }
        else
        {
            $response['rc'] = FALSE;
        }
        return $response;
    }

    function update_popular_news($news_id, $data)
    {
        $news = $this->db->get_where('news', array('is_popular_news' => 1))->result_array();
        if(count($news) < POPULAR_NEWS && $data['is_checked'] == 1)
        {
            $this->db->where('id',$news_id);
            $this->db->update('news', array('is_popular_news' => 1));
            $response['rc'] = TRUE;
        }
        elseif($data['is_checked'] == 0)
        {
            $this->db->where('id',$news_id);
            $this->db->update('news', array('is_popular_news' => 0));
            $response['rc'] = TRUE;
        }
        else
        {
            $response['rc'] = FALSE;
        }
        return $response;
    }
    
    function activate($news_id)
    {
        $this->db->where('id',$news_id);
        $this->db->update('news',array('is_active' => 1));
        return TRUE;
    }
    
    function deactivate($news_id)
    {
        $this->db->where('id',$news_id);
        $this->db->update('news',array('is_active' => 0));
        return TRUE;
    }

    function comment_approved($comment_id)
    {
        $this->db->where('id',$comment_id);
        $this->db->update('news_has_comments',array('is_approved' => 1, 'is_pending' => 0));
        return TRUE;
    }
    
    function comment_rejected($comment_id)
    {
        $this->db->where('id',$comment_id);
        $this->db->update('news_has_comments',array('is_approved' => 0, 'is_pending' => 0));
        return TRUE;
    }

    function get_approved_comments($news_id)
    {
        $comments = $this->db->get_where('news_has_comments',array('news_id' => $news_id, 'is_approved' => 1))->result_array();
        return $comments;
    }
 
    function delete_comment($comment_id)
    {
        
        $comment = $this->db->get_where('news_has_comments',array('id'=>$comment_id))->row_array();
        $this->db->delete('news_has_comments',array('id'=>$comment_id));
        return $comment;
    }

    function sort_news_order($order_array)      
    {           
        foreach($order_array['row'] as $position => $id)            
        {               
            $this->db->query("UPDATE news SET sort_order = ".($position+1)." where id = ".$id);         
        }           
        return TRUE;        
    }

}
?>
