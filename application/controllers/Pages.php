<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Pages extends BaseController
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta');
        $this->load->model('Admin_model');
        $this->load->model('News_model');
        $this->load->model('Page_model');
        // if($this->uri->total_segments() === 0){
        //     redirect('home', 'location', 301);
        // }
    }

    function addVisitor()
    {
        $ip = $this->input->ip_address();
       
        if ($this->input->valid_ip($ip)) 
        {
            $data['ip']=$ip;
            $this->Page_model->addVisitor($data);
        }     
    }
    
    function rashifal()
    {
        $data['rashifal'] = $this->News_model->get_rashifal();
    	
    	$popular_params = array('is_popular_news' => 1);
        $data['popular_news'] = $this->News_model->get_news($popular_params);
       
        $data['header'] = TRUE;
        $data['footer'] = TRUE;
        $data['active_title'] = 'विकास मान';
        $data['active_menu'] = 'अन्य';
        $data['active_submenu'] = 'राशिफल';
        $data['_view'] = 'pages/horoscope-rashifal';
        $this->load->view('layout/basetemplate',$data);   
    }

    function home()
    {
        $params = array(
            'is_home_page' => 1
            );

        $news = $this->News_model->get_news($params);

        $arr = array();

        foreach($news as $key => $item)
        {
           $arr[$item['category_id']][$key] = $item;
        }
        //pr($arr);exit;
        ksort($arr, SORT_NUMERIC);
        $data['news'] = $arr;

        $popular_params = array('is_popular_news' => 1);
        $data['popular_news'] = $this->News_model->get_news($popular_params);
        // pr($data['news']);exit;
        $data['active_page'] = 'homepage';
        $data['active_menu'] = 'home';
        $data['active_submenu'] = 'home';
        $data['active_title'] = 'विकास मान';
        $data['header'] = TRUE;
        $data['footer'] = TRUE;
        $data['_view'] = 'pages/home';
        $this->load->view('layout/basetemplate',$data);  
    }

    function news_listing($category_url = '', $page_number = 0)
    {
        if(!empty($category_url) && checkUrlParam('meta_categories', 'category_url', $category_url))
        {
            $news = $this->News_model->get_category_by_url($category_url);
            $data['category'] = $news;
            $params = array(
                'category_id'   => $news['id'],
                'limit'         => $page_number,
                'offset'        => NO_OF_ROWS
                );//pr($params);exit;
            $data['news'] = $this->News_model->get_news($params);

            $popular_params = array('is_popular_news' => 1);
            $data['popular_news'] = $this->News_model->get_news($popular_params);
        
            $this->load->library('pagination');
        
            $config["base_url"] = site_url($category_url.'/page');
            
            $total_row = $this->News_model->news_count($params);

            $config["total_rows"] = $total_row;
            // $config['use_page_numbers'] = TRUE;
            $config["per_page"] = NO_OF_ROWS;
            $config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = '>';
            $config['prev_link'] = '<';

            $this->pagination->initialize($config);
            
            $data['active_page'] = 'homepage';
            if($news['category_name'] == 'एजुकेशन' || $news['category_name'] == 'कृषि' || $news['category_name'] == 'रोजगार' || $news['category_name'] == 'स्वास्थ्य' || $news['category_name'] == 'धर्म' || $news['category_name'] == 'राशिफल' || $news['category_name'] == 'विचार')
            {
                $data['active_menu'] = 'अन्य';
            }
            elseif($news['category_name'] == 'बिज़नेस' || $news['category_name'] == 'टेक्सटाइल')
            {
                $data['active_menu'] = 'बिज़नेस';
            }
            else
            {
                $data['active_menu'] = $news['category_name'];
            }
            $data['active_submenu'] = $news['category_name'];
            $data['active_title'] = $news['category_name'].' | विकास मान';
            $data['header'] = TRUE;
            $data['footer'] = TRUE;
            $data['_view'] = 'pages/news_listing';
            $this->load->view('layout/basetemplate',$data); 
        } 
    }

    function news_detail($category_url = '', $news_url = '')
    {
        if(!empty($category_url) && checkUrlParam('meta_categories', 'category_url', $category_url) && !empty($news_url) && checkUrlParam('news', 'url', $news_url))
        {
            $data['news'] = $this->News_model->get_news_by_url(urldecode($news_url));

            $popular_params = array('is_popular_news' => 1);
            $data['popular_news'] = $this->News_model->get_news($popular_params);
        
            $related_news_params = array('category_id' => $data['news']['category_id']);
            $data['related_news'] = $this->News_model->get_related_news($data['news']['id'], $related_news_params);

            $data['like_unlike_count'] = $this->Page_model->get_like_count($data['news']['id']);

            $data['comments']['comments'] = $this->News_model->get_approved_comments($data['news']['id']);

            $data['active_page'] = 'homepage';
            if($data['news']['category_name'] == 'एजुकेशन' || $data['news']['category_name'] == 'कृषि' || $data['news']['category_name'] == 'रोजगार' || $data['news']['category_name'] == 'स्वास्थ्य' || $data['news']['category_name'] == 'धर्म' || $data['news']['category_name'] == 'राशिफल' || $data['news']['category_name'] == 'विचार')
            {
                $data['active_menu'] = 'अन्य';
            }
            elseif($data['news']['category_name'] == 'बिज़नेस' || $data['news']['category_name'] == 'टेक्सटाइल')
            {
                $data['active_menu'] = 'बिज़नेस';
            }
            else
            {
                $data['active_menu'] = $data['news']['category_name'];
            }
            $data['active_submenu'] = $data['news']['category_name'];
            $data['active_title'] = $data['news']['title'].' | विकास मान';
            $data['header'] = TRUE;
            $data['footer'] = TRUE;
            $data['_view'] = 'pages/news_detail';
            $this->load->view('layout/basetemplate',$data);  
        }
        elseif(!empty($category_url) && checkUrlParam('meta_categories', 'category_url', $category_url))
        {
            redirect(site_url($category_url));  
        }
        else
        {
            redirect(base_url());
        }
    }

    function likes()
    {
        $result['status'] = FALSE;
        if(!empty($_POST["id"])) {
            $response = $this->Page_model->likes($this->input->post());
            if($response['rc'])
            {
                $result['status'] = TRUE;
            }
        }
        echo json_encode($result);exit;
    }

    function unlikes()
    {
        $result['status'] = FALSE;
        if(!empty($_POST["id"])) {
            $response = $this->Page_model->unlikes($this->input->post());
            if($response['rc'])
            {
                $result['status'] = TRUE;
            }
        }
        echo json_encode($result);exit;
    }

    function add_comment()
    {
        $this->form_validation->set_rules('name','Name','required|trim|max_length[50]');
        $this->form_validation->set_rules('email','Email','required|valid_email|max_length[150]');
        $this->form_validation->set_rules('mobile_number','Mobile Number','required|numeric|trim|max_length[10]');
        $this->form_validation->set_rules('comment','Comment','required|trim|max_length[250]');

        if ($this->form_validation->run())
        {
            $comment = array(
                'news_id'       => $this->input->post('news_id'),
                'is_approved'   => 0,
                'name'          => $this->input->post('name'),
                'email'         => $this->input->post('email'),
                'mobile_number' => $this->input->post('mobile_number'),
                'comment'       => $this->input->post('comment'),
                'added_on'      => date('Y-m-d H:i:s')
                );
            $this->Page_model->add_comment($comment);

            $response = array(
                'rc'    => TRUE,
                'msg'   =>  'Your comment is successfully submitted and is pending for approval from admin.'
                );
        }
        else
        {
            $response = array(
                'rc'    => FALSE,
                'msg'   =>  validation_errors()
                );
        }
        echo json_encode($response);
    }

    function download($post_id)
    {
        $post_data = $this->Page_model->get_post_by_id($post_id);
        $extension = ".".pathinfo($post_data['post'], PATHINFO_EXTENSION);
        $ext = strtolower($extension);
        
        if($post_data['post_type'] == UPLOADED_VIDEO)
        {
            $dir = FCPATH.'resources/posts/video/'.$post_data['user_id'].'/';
        }   
        else
        {
            $dir = FCPATH.'resources/posts/img/'.$post_data['user_id'].'/';
        } 
        
        $filename = $dir.$post_data['post'];
           
        $this->load->helper('download');
        $simhastha = file_get_contents($filename); // Read the file's contents
        $name = 'Simhastha.'.$ext;
        force_download($name, $simhastha);
    }

    function forgot_password()
    {
        if($this->session->userdata('user_id'))
        {
            redirect('home');
        }
        
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|callback_valid_username|xss_clean|max_length[150]');
        
        if($this->form_validation->run() === TRUE)
        {
            

            require FCPATH.APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php';

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'hits03.hostitsmart.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'contact@simhasthaonline.in';                 // SMTP username
            $mail->Password = 'sim12345';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $subject = "Reset Password";

            $from = ADMIN_EMAIL;
            $to = $this->input->post('email');
            $user = $this->Page_model->get_password_key($to);
            
            $mail->setFrom($from, 'Simhastha Ujjain 2016');
            $mail->addAddress($to);               // Name is optional
            $mail->addReplyTo($from, 'Simhastha Ujjain 2016');
            $mail->isHTML(true);                                  // Set email format to HTML
            
            $message = array(
                        'firstname' => $user['firstname'],
                        'lastname' => $user['lastname'],
                        'link' => base_url().'reset-password/'.$user['password_key']
                );
            $email_view = $this->load->view('email/forgot_password',$message,TRUE);
        
            $mail->Body    = $email_view;
            
            if(!$mail->send()) {
                $this->session->set_flashdata('error', $mail->ErrorInfo);
            } else {
                $this->session->set_flashdata('success', 'Reset Password link has been sent to your E-mail ID');
            }
            redirect('forgot-password');
        }

        $data['active_page'] = 'default nieuwewagens';
        $data['active_menu'] = 'login';
        $data['active_title'] = 'Forgot Password';
        $data['header'] = TRUE;
        $data['footer'] = TRUE;
        $data['_view'] = 'pages/forgot_password';
        $this->load->view('layout/basetemplate',$data);
    }
    
    function reset_password($key=NULL)
    {
        if($this->session->userdata('user_id'))
        {
            redirect('home');
        }
        
        $response1 = $this->Page_model->check_password_key($key);
        $data = $response1['data'];
        if(!$response1['rc'])
        {
            $this->session->set_flashdata('success',$response1['msg']);
            redirect('posts');
        }
        
        $this->form_validation->set_rules('new_password','New Password','trim|required|min_length[6]|xss_clean|max_length[50]');
        $this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|matches[new_password]|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $new_password = md5($this->input->post('new_password'));
            $response2 = $this->Page_model->reset_password($key,$new_password);
            if($response2['rc'])
            {
                $this->session->set_flashdata('success',$response2['msg']);
            }
            else
            {
                $this->session->set_flashdata('success',$response2['msg']);
            }
            
            redirect('posts');exit;
        }
        
        $data['active_page'] = 'default nieuwewagens';
        $data['active_menu'] = 'login';
        $data['active_title'] = 'Reset Password';
        $data['header'] = TRUE;
        $data['footer'] = TRUE;
        $data['_view'] = 'pages/reset_password';
        $this->load->view('layout/basetemplate',$data);
    }
    
    function change_password()
    {
        if($this->session->userdata('user_id'))
        {
            $this->form_validation->set_rules('new_password','New Password','trim|required|min_length[6]|xss_clean|max_length[50]');
            $this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|matches[new_password]|xss_clean');
            if($this->form_validation->run() == TRUE)
            {
                $new_password = md5($this->input->post('new_password'));
                $response = $this->Page_model->change_password($this->session->userdata('user_id'), $new_password);
                if($response['rc'])
                {
                    $this->session->set_flashdata('success',$response['msg']);
                }
                else
                {
                    $this->session->set_flashdata('error',$response['msg']);
                }
                redirect(base_url('settings'));
            }
            
            $data['active_page'] = 'default nieuwewagens';
            $data['active_menu'] = 'login';
            $data['active_title'] = 'Change Password';
            $data['header'] = TRUE;
            $data['footer'] = TRUE;
            $data['_view'] = 'pages/change_password';
            $this->load->view('layout/basetemplate',$data);
        }
    }  
    
    function add_message()
    {
        $this->form_validation->set_rules('name','Name','required|max_length[50]');
        $this->form_validation->set_rules('contact_number','Contact Number','required|max_length[10]');
        $this->form_validation->set_rules('email','Email','valid_email|max_length[100]');
        $this->form_validation->set_rules('comment','Description','required|max_length[490]');
            
        if($this->form_validation->run())
        {
            //echo "Control come in 'if'";
           	$data = array(
                'name' => $this->input->post('name'),
                'message' => $this->input->post('comment'),
                'email' => $this->input->post('email'),
                'contact_number' => $this->input->post('contact_number'),
                'date_time' => date('Y-m-d H:i:s'),
                'is_read' => 0
                );
                
               $message_id = $this->Page_model->add_message($data);
            
                $this->session->set_flashdata('successmsg', 'Request successfully sent');
              redirect('contact');        
        }
        else
        {
            $popular_params = array('is_popular_news' => 1);
            
            $data['popular_news'] = $this->News_model->get_news($popular_params);
            $data['active_page'] = 'Contact';
            $data['active_menu'] = 'contact';
            $data['active_submenu'] = 'contact';
            $data['active_title'] = 'Contact Us '.'| विकास मान';
            $data['header'] = TRUE;
            $data['footer'] = TRUE;
            $data['_view'] = 'pages/contact';
            $this->load->view('layout/basetemplate',$data);
        }
    }

}
?>
