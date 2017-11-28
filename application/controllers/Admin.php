<?php
ini_set ('gd.jpeg_ignore_warning', 1);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('News_model');
        $this->load->model('Page_model');
    }

    function is_logged_in()
    {
        if($this->session->userdata('admin_id') > 0)
            return TRUE;
        else
            return FALSE;
    }

    function authenticate()
    {
        if($this->is_logged_in())
        {
            // TODO: In the future if any other auth needs to be implemented (example: related to org or something)
        }
        else
        {
            redirect('admin');
            exit;
        }
    }
    
    function login()
    {
        $this->form_validation->set_rules('username','Username','required|trim');
        $this->form_validation->set_rules('password','Password','required|trim');

        if ($this->form_validation->run() == FALSE)
        {
            $data['header'] = FALSE;
            $data['_view'] = 'admin/login';
            $this->load->view('admin/basetemplate',$data);
        }
        else
        {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $userDetails = $this->Admin_model->login($username,$password);
            if($userDetails)
            {  
                redirect('admin/dashboard');
            }
            else
            {
                $this->session->set_flashdata('errormsg','Invalid Username Or Password');
                redirect('admin');
            }
        }
    }
    
    function dashboard()
    {
        $this->authenticate();

        $data = array(
            'category_id' => ''
            );
        $data['news'] = $this->News_model->get_news($data);

        $data['header'] = TRUE;
        $data['footer'] = TRUE;
        $data['active']['tab'] = FALSE;
        $data['active']['arrow'] = FALSE;
        $data['active_menu'] = 'dashboard';
        $data['_sidebar'] = 'admin/sidebar';
        $data['_view'] = 'admin/dashboard';
        $this->load->view('admin/basetemplate',$data);
    }
    
    function logout()
    {
        $this->session->sess_destroy();
        redirect('admin');
    } 

    function updateProfile()
    {
    	$s_admin_id = $this->session->userdata('admin_id');

    	$admin = $this->Admin_model->get_admin_details($s_admin_id);
    	$data['admin'] = $admin;

    	if(isset($admin['id']))
		{
			if($this->input->post('action_name') == '')
			{
			$data['header'] = TRUE;
	                $data['footer'] = TRUE;
	                $data['active']['tab'] = FALSE;
	                $data['active']['arrow'] = FALSE;
	                $data['active_menu'] = '';
	                $data['_sidebar'] = 'admin/sidebar';
	                $data['_view'] = 'admin/profile';
	                $this->load->view('admin/basetemplate',$data);
			}
			elseif($this->input->post('action_name') == 'updateProfilePicture')
		    	{
		    	    if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] == '')
		            {
		                $this->form_validation->set_rules('picture','Picture','required');
		            }
		            else
		            {
		                $this->form_validation->set_rules('picture','Picture','');
		            }
	
		            if($this->form_validation->run() || isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != '')     
		            {   
		                $this->Admin_model->update_profile_picture($s_admin_id,$_FILES);
		                $this->session->set_flashdata('successmsg','Profile Picture Successfully Updated');
		                redirect('admin/updateProfile');
		            }
		            else
		            {   
		                $data['header'] = TRUE;
		                $data['footer'] = TRUE;
		                $data['active']['tab'] = FALSE;
		                $data['active']['arrow'] = FALSE;
		                $data['active_menu'] = '';
		                $data['_sidebar'] = 'admin/sidebar';
		                $data['_view'] = 'admin/profile';
		                $this->load->view('admin/basetemplate',$data);
		            }
			    }
		    	elseif($this->input->post('action_name') == 'changePassword')
		    	{
		    	    $this->form_validation->set_rules('new_password','New Password','required|max_length[25]|matches[confirm_password]');
		            $this->form_validation->set_rules('confirm_password','Confirm Password','required|max_length[25]');
		        
		            if($this->form_validation->run())     
		            {   
		                $params = array(
		                    'password' => md5($this->input->post('new_password'))
		                );
	
		                $this->Admin_model->change_password($s_admin_id,$params);  
		                $this->session->set_flashdata('successmsg','Password Successfully Changed');
		                redirect('admin/updateProfile');
		            }
		            else
		            {   
		                $data['header'] = TRUE;
		                $data['footer'] = TRUE;
		                $data['active']['tab'] = FALSE;
		                $data['active']['arrow'] = FALSE;
		                $data['active_menu'] = '';
		                $data['_sidebar'] = 'admin/sidebar';
		                $data['_view'] = 'admin/profile';
		                $this->load->view('admin/basetemplate',$data);
		            }
		    	}
		    	elseif($this->input->post('action_name') == 'updateAdminName')
		    	{ 
		    	   $this->form_validation->set_rules('admin_name','Name','required|max_length[45]');
		        
		            if($this->form_validation->run())     
		            {   
		                $params = array(
		                    'name' => $this->input->post('admin_name')
		                );
	
		                $this->Admin_model->update_admin($s_admin_id,$params);  
		                $this->session->set_flashdata('successmsg','Name Successfully Updated');
		                redirect('admin/updateProfile');
		            }
		            else
		            {   
		                $data['header'] = TRUE;
		                $data['footer'] = TRUE;
		                $data['active']['tab'] = FALSE;
		                $data['active']['arrow'] = FALSE;
		                $data['active_menu'] = '';
		                $data['_sidebar'] = 'admin/sidebar';
		                $data['_view'] = 'admin/profile';
		                $this->load->view('admin/basetemplate',$data);
		            }
		    	}
	}
	else
        {    
            show_error('The admin you are trying to edit does not exist.');
        }

    }
    
    function delete_message($id = 0)
    {
        if(is_numeric($id) && checkUrlParam('contact_message','id',$id))
        {
            $result = $this->News_model->delete_message($id);
            if($result)
            {
                $this->session->set_flashdata('successmsg','Message Successfully Deleted.');
                redirect('admin/contact');
            }
            else
            {
                $this->session->set_flashdata('errormsg','Error occuring in deleting message');
                redirect('admin/contact');
            }
        }
        else
        {
            show_error('Invalid data');
        }   
    }
    
    function update_message_status($id = 0)
    {
        if(is_numeric($id) && checkUrlParam('contact_message','id',$id))
        {
        	$data = array(
            'is_read' => 1
       	    );
            $result = $this->News_model->update_message_status($data,$id);
            if($result)
            {
                $this->session->set_flashdata('successmsg','Action Successful');
                redirect('admin/contact');
            }
            else
            {
                $this->session->set_flashdata('errormsg','Error');
                redirect('admin/contact');
            }
        }
        else
        {
            show_error('Invalid data');
        }   
    }
    
    function contact()
    {
        $data['contact'] = $this->News_model->get_contact();
        $data['message'] = $this->News_model->get_messages();

        $data['header'] = TRUE;
        $data['footer'] = TRUE;
        $data['active']['tab'] = FALSE;
        $data['active']['arrow'] = FALSE;
        $data['active_menu'] = 'contact';
        $data['_view'] = 'admin/contact';
        $this->load->view('admin/basetemplate',$data);   
    }

    function delete_contact($id = 0)
    {
        if(is_numeric($id) && checkUrlParam('contact','id',$id))
        {
            $result = $this->News_model->delete_contact($id);
            if($result)
            {
                $this->session->set_flashdata('successmsg','Headline Deleted Successfully.');
                redirect('admin/contact');
            }
            else
            {
                $this->session->set_flashdata('errormsg','Error occuring in deleting headline');
                redirect('admin/dashboard');
            }
        }
        else
        {
            show_error('Invalid data');
        }   
    }

    function edit_contact()
    {
        
        $data = array(
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'pin_code' => $this->input->post('pin'),
            'phone' => $this->input->post('phone'),
            'state' => $this->input->post('state')
        );
            
        $contact_id = $this->News_model->update_contact($data,$this->input->post('id'));
        
        if($contact_id > 0)
        {
            $this->session->set_flashdata('successmsg','Contact Updated Successfully.');
            redirect('admin/contact');
        }
        else 
        {
            $this->session->set_flashdata('errormsg','Unable to update.');
            redirect('admin/contact');
        }
    }

    function add_contact()
    {
   
        $data = array(
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'pin_code' => $this->input->post('pin'),
            'phone' => $this->input->post('phone'),
            'state' => $this->input->post('state')
            );
            
        $contact_id = $this->News_model->add_contact($data);
        
        if($contact_id > 0)
        {
            $this->session->set_flashdata('successmsg','Contact Added Successfully.');
            redirect('admin/contact');
        }
        else 
        {
            $this->session->set_flashdata('errormsg','Unable to add.');
            redirect('admin/contact');
        }
    }

    function rashifal()
    {
        $this->authenticate();

        $data['rashifal'] = $this->News_model->get_rashifal();

        $data['header'] = TRUE;
        $data['footer'] = TRUE;
        $data['active']['tab'] = FALSE;
        $data['active']['arrow'] = FALSE;
        $data['active_menu'] = 'rashifal';
        $data['_view'] = 'admin/rashifal';
        $this->load->view('admin/basetemplate',$data);   
    }

    function edit_rashifal()
    {
        $this->authenticate();

        $data = array(
            'description' => $this->input->post('description')
            );
            
        $rashi_id = $this->News_model->update_rashifal($data,$this->input->post('id'));
        
        if($rashi_id > 0)
        {
            $this->session->set_flashdata('successmsg','Rashifal Updated Successfully.');
            redirect('rashifal');
        }
        else 
        {
            $this->session->set_flashdata('errormsg','Unable to update.');
            redirect('rashifal');
        }
       
    }

    function headlines()
    {
        $this->authenticate();

        $data['headlines'] = $this->News_model->get_headlines();

        $data['header'] = TRUE;
        $data['footer'] = TRUE;
        $data['active']['tab'] = FALSE;
        $data['active']['arrow'] = FALSE;
        $data['active_menu'] = 'headlines';
        $data['_view'] = 'admin/headlines';
        $this->load->view('admin/basetemplate',$data);   
    }

    function delete_headline($id = 0)
    {
        $this->authenticate();

        if(is_numeric($id) && checkUrlParam('headlines','id',$id))
        {
            $result = $this->News_model->delete_headlines($id);
            if($result)
            {
                $this->session->set_flashdata('successmsg','Headline Deleted Successfully.');
                redirect('headlines');
            }
            else
            {
                $this->session->set_flashdata('errormsg','Error occuring in deleting headline');
                redirect('admin/dashboard');
            }
        }
        else
        {
            show_error('Invalid data');
        }   
    }

    function edit_headline()
    {
        $this->authenticate();
        $this->form_validation->set_rules('title','Headline','required|trim');
        
        if ($this->form_validation->run())
        {
            $data = array(
                'news_headline' => $this->input->post('title')
                );
                
            $headline_id = $this->News_model->update_headlines($data,$this->input->post('id'));
            
            if($headline_id > 0)
            {
                $this->session->set_flashdata('successmsg','Headline Updated Successfully.');
                redirect('headlines');
            }
            else 
            {
                $this->session->set_flashdata('errormsg','Unable to update.');
                redirect('headlines');
            }
        }
        else
        {
            $this->session->set_flashdata('errormsg','Unable to update.');
            redirect('headlines');
        }
    }

    function add_headline()
    {
        $this->authenticate();

        $this->form_validation->set_rules('title','Headline','required|trim');
        
        if ($this->form_validation->run())
        {
            $data = array(
                'news_headline' => $this->input->post('title')
                );
                
            $headline_id = $this->News_model->add_headlines($data);
            
            if($headline_id > 0)
            {
                $this->session->set_flashdata('successmsg','Headline Added Successfully.');
                redirect('headlines');
            }
            else 
            {
                $this->session->set_flashdata('errormsg','Unable to add.');
                redirect('headlines');
            }
        }
        else
        {
            redirect('admin/dashboard');
        }
    }


    function news($id = 0)
    {
        $this->authenticate();

        if(is_numeric($id) && checkUrlParam('meta_categories', 'id', $id))
        {
            $data = array(
                'category_id'   => $id,
                'limit'         => $this->input->get('per_page'),
                'offset'        => NO_OF_ROWS
                );
            $data['news'] = $this->News_model->get_news($data);

            $this->load->library('pagination');
        
            $config["base_url"] = site_url('admin/news/'.$id.'?');
            
            $total_row = $this->News_model->news_count($data);

            $config["total_rows"] = $total_row;
            $config['uri_segment'] = 3;
            $config["per_page"] = NO_OF_ROWS;
            $config['page_query_string'] = TRUE;
            $config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = '>';
            $config['prev_link'] = '<';

            $this->pagination->initialize($config);
            
            $data['header'] = TRUE;
            $data['footer'] = TRUE;
            $data['active']['tab'] = FALSE;
            $data['active']['arrow'] = FALSE;
            $data['active_menu'] = 'category';
            if($id == VIDEO)
            {
                $data['_view'] = 'admin/video';
            }
            else
            {
                $data['_view'] = 'admin/category';
            }
            $this->load->view('admin/basetemplate',$data);    
        }
        else
        {
            $data = array(
                'category_id' => '',
                'limit'         => $this->input->get('per_page'),
                'offset'        => NO_OF_ROWS
                );
            $data['news'] = $this->News_model->get_news($data);

            $this->load->library('pagination');
        
            $config["base_url"] = site_url('admin/news/'.$id.'?');
            
            $total_row = $this->News_model->news_count($data);

            $config["total_rows"] = $total_row;
            $config['uri_segment'] = 3;
            $config["per_page"] = NO_OF_ROWS;
            $config['page_query_string'] = TRUE;
            $config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = '>';
            $config['prev_link'] = '<';

            $this->pagination->initialize($config);
            
            $data['header'] = TRUE;
            $data['footer'] = TRUE;
            $data['active']['tab'] = FALSE;
            $data['active']['arrow'] = FALSE;
            $data['active_menu'] = 'category';
            $data['_view'] = 'admin/category';
            $this->load->view('admin/basetemplate',$data); 
        }
    }
    
    function add_news()
    {
        $this->authenticate();

        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('url','Url','required');
        
        if ($this->form_validation->run())
        {
            $news_data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'url' => strtolower(str_replace(' ', '-', $this->input->post('url'))),
                'category_id' => $this->input->post('category_id'),
                'is_active' => 1,
                'added_on' => date('Y-m-d H:i:s')
                 );
            $news_id = $this->News_model->add_news($news_data,$_FILES);
            
            if($news_id > 0)
            {
                if($this->input->post('category_id'))
                {
                    $this->session->set_flashdata('successmsg','News Successfully Added.');
                    redirect('admin/news/'.$this->input->post('category_id'));
                }
                else
                {
                   $this->session->set_flashdata('errormsg','Error occur in adding news.');    
                    redirect('admin/news/'.$this->input->post('category_id'));
                }
            }
            else 
            {
                show_error('Data was not added, please contact your administrator');
            }
        }
        else
        {
            redirect('admin/dashboard');
        }
    }
    
    function edit_news()
    {
        $this->authenticate();

        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('url','Url','required');
         
        if ($this->form_validation->run())
        {
            $news_data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'url' => strtolower(str_replace(' ', '-', $this->input->post('url')))
                 );
            $news_id = $this->News_model->update_news($news_data,$this->input->post('id'),$_FILES);
            
            if($news_id > 0)
            {
                if($this->input->post('category_id'))
                {
                    $this->session->set_flashdata('successmsg','News Updated Successfully.');
                    redirect('admin/news/'.$this->input->post('category_id'));
                }
                else
                {
                     $this->session->set_flashdata('errormsg','Error occuring in updating news.');   
                     redirect('admin/news/'.$this->input->post('category_id'));
                }
            }
            else 
            {
                show_error('Data was not added, please contact your administrator');
            }
        }
        else
        {
            redirect('admin/dashboard');
        }
    }
    
    function delete_news($id = 0)
    {
        $this->authenticate();
        
        if(is_numeric($id) && checkUrlParam('news','id',$id))
        {
            $result = $this->News_model->delete_news($id);
            if($result['category_id'])
            {
                $this->session->set_flashdata('successmsg','News Deleted Successfully.');
                redirect('admin/news/'.$result['category_id']);
            }
            else
            {
                $this->session->set_flashdata('errormsg','Error occuring in deleting news.');
                redirect('admin/news/'.$result['category_id']);
            }
            
            
        }
        else
        {
            show_error('Invalid data');
        }
    }

    function update_main_news($news_id = 0, $category_id = 0)
    {
        $this->authenticate();

        if(is_numeric($news_id) && checkUrlParam('news', 'id', $news_id, TRUE) && is_numeric($category_id) && checkUrlParam('news', 'category_id', $category_id, TRUE))
         {
            $news_data = array(
                'is_main_news' => 1
                );
            $news_id = $this->News_model->update_main_news($news_id, $category_id, $news_data);
            
            if($news_id > 0)
            {
                $this->session->set_flashdata('successmsg','News Updated Successfully.');
                redirect('admin/news/'.$category_id);
            }
            else 
            {
                show_error('Data was not added, please contact your administrator');
                
            }
         }
        else
        {
            show_error('Invalid data');
        }
    }

    function update_other_news($news_id = 0, $category_id = 0, $is_checked = 0)
    {
        if($this->session->userdata('admin_id'))
        {
            if(is_numeric($news_id) && checkUrlParam('news', 'id', $news_id, TRUE) && is_numeric($category_id) && checkUrlParam('news', 'category_id', $category_id, TRUE))
            {
                if($is_checked == 1)
                {
                    $news_data = array('is_checked' => 1);
                }
                else
                {
                    $news_data = array('is_checked' => 0);
                }
                $response = $this->News_model->update_other_news($news_id, $category_id, $news_data);
                
                if($response['rc'] == 1)
                {
                    $result['status'] = TRUE;
                    $result['msg'] = 'News Updated Successfully.';
                    $this->session->set_flashdata('successmsg','News Updated Successfully.');          
                    redirect('admin/news/'.$category_id);
                }
                else 
                {
                    $result['status'] = TRUE;
                    $result['msg'] = OTHER_NEWS.' News are already selected. Please unselect from them and try again';
                    $this->session->set_flashdata('errormsg','You cannot select more than 4 news');
                    redirect('admin/news/'.$category_id);
                }
                
               // echo json_encode($result);
            }
            else
            {
                $result['status'] = FALSE;
                $result['msg'] = 'Invalid Data';
                redirect('admin/news/'.$category_id);
              //  echo json_encode($result);
            }
        }
        else
        {
            $result['status'] = FALSE;
            $result['msg'] = 'Please login again';
            echo json_encode($result);
        } 
    }

    function update_popular_news($news_id = 0, $category_id = 0)
    {
        if($this->session->userdata('admin_id'))
        {
            if(is_numeric($news_id) && checkUrlParam('news', 'id', $news_id, TRUE) && is_numeric($category_id) && checkUrlParam('news', 'category_id', $category_id, TRUE))
            {
                if($this->input->post('is_checked') == 1)
                {
                    $news_data = array('is_checked' => 1);
                }
                else
                {
                    $news_data = array('is_checked' => 0);
                }
                $response = $this->News_model->update_popular_news($news_id, $news_data);
                
                if($response['rc'] == 1)
                {
                    $result['status'] = TRUE;
                    $result['msg'] = 'News Updated Successfully.';
                    $this->session->set_flashdata('successmsg','News Updated Successfully.');          
                    //redirect('admin/news/'.$category_id);
                
                }
                else 
                {
                    $result['status'] = FALSE;
                    $result['msg'] = POPULAR_NEWS.' News are already selected. Please unselect from them and try again';
                    $this->session->set_flashdata('errormsg','You cannot select more than 10 news');
                    //redirect('admin/news/'.$category_id);
                }

                echo json_encode($result);
            }
            else
            {
                $result['status'] = FALSE;
                $result['msg'] = 'Invalid Data';
                echo json_encode($result);
            }
        }
        else
        {
            $result['status'] = FALSE;
            $result['msg'] = 'Please login again';
            echo json_encode($result);
        } 
    }
    
    function activate($news_id = 0)
    {
        $this->authenticate();
        $news = $this->News_model->get_news_by_id($news_id);

        if(is_numeric($news_id) && checkUrlParam('news', 'id', $news_id, TRUE))
        {
            $result = $this->News_model->activate($news_id);
            
            if($result)
            {
                $this->session->set_flashdata('successmsg','News Activated');
                redirect('admin/news/'.$news['category_id']);
            }
        }
        else
        {
            show_error('Invalid data');
        } 
    }
    
    function deactivate($news_id = 0)
    {
        $this->authenticate();
	$news = $this->News_model->get_news_by_id($news_id);

        if(is_numeric($news_id) && checkUrlParam('news', 'id', $news_id, TRUE))
        {
            $result = $this->News_model->deactivate($news_id);
            
            if($result)
            {
                $this->session->set_flashdata('successmsg','News Deactivated');
                redirect('admin/news/'.$news['category_id']);
            }
        }
        else
        {
            show_error('Invalid data');
        }
    }

    function sort_news_order()
    {
        $this->News_model->sort_news_order($this->input->post());
    }

    function users()
    {
        $this->authenticate();

        $data['users'] = $this->Admin_model->getUserList();
        $data['header'] = TRUE;
        $data['footer'] = TRUE;
        $data['active']['tab'] = FALSE;
        $data['active']['arrow'] = FALSE;
        $data['active_menu'] = 'users';
        $data['_sidebar'] = 'admin/sidebar';
        $data['_view'] = 'admin/user_listing';
        $this->load->view('admin/basetemplate',$data);
    }

    function login_profile($profile_id = 0)
    {
       
        if($this->session->userdata('admin_id'))
        {
            if(!checkUrlParam('users', 'id', $profile_id))
            {
                show_error('Invalid Data.');
            }
            else 
            {
                $details = $this->Admin_model->getDetailsByUserId($profile_id);
               
                if(!empty($details))
                {
                    $this->session->set_userdata('user_id',$profile_id);
                    $this->session->set_userdata('email',$details['email']);
                    redirect('home');
                }
                else
                {
                    show_error('Invalid Data.');
                }
            }
        }
        else
        {
            redirect('admin/login');
        }
    }
    
    function view_post($id = 0)
    {
        if($this->session->userdata('admin_id'))
        {
            if(!checkUrlParam('users', 'id', $id))
            {
                show_error('Invalid Data.');
            }
            else 
            {
                $data['my_posts'] = $this->Page_model->get_post_by_user_id($id);
              
                $data['header'] = TRUE;
                $data['footer'] = TRUE;
                $data['active']['tab'] = FALSE;
                $data['active']['arrow'] = FALSE;
                $data['active_menu'] = 'users';
                $data['_sidebar'] = 'admin/sidebar';
                $data['_view'] = 'admin/view_post';
                $this->load->view('admin/basetemplate',$data);
            }
        }
        else
        {
            redirect('admin');
        }
    }

    function delete_post($id = 0)
    {
        if($this->session->userdata('admin_id'))
        {
            if(is_numeric($id) && checkUrlParam('user_has_posts','id',$id))
            {
                $post = $this->Page_model->get_post_by_id($id);
                
                if($this->Admin_model->delete_post($id))
                {
                    $this->session->set_flashdata('successmsg','Post Deleted Successfully.');
                }
                else
                {
                    $this->session->set_flashdata('errormsg','This post has reference in another table,so cannot be deleted.');
                }
                redirect('admin/view_post/'.$post['user_id']);
            }
            else
            {
                show_error('Invalid data');
            }
        }
        else
        {
            redirect('admin/login');
        } 
    }

    function comments()
    {
        $this->authenticate();

        $params['offset'] = NO_OF_ROWS;
        if($this->input->get('per_page'))
        {
            $params['limit'] = $this->input->get('per_page');
        }
        
        $comments = $this->Admin_model->get_all_comments($params);
        if($comments['rc'])
        {
            $data['comments'] = $comments['data'];
        }

        $this->load->library('pagination');
        
        $config["base_url"] = site_url('admin/comments?');
        
        $total_row = $this->Admin_model->comment_count();

        $config["total_rows"] = $total_row;
        $config['uri_segment'] = 3;
        $config["per_page"] = NO_OF_ROWS;
        $config['page_query_string'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = '>';
        $config['prev_link'] = '<';

        $this->pagination->initialize($config);
        
        $data['header'] = TRUE;
        $data['footer'] = TRUE;
        $data['active']['tab'] = FALSE;
        $data['active']['arrow'] = FALSE;
        $data['active_menu'] = 'comments';
        $data['_view'] = 'admin/comments';
        $this->load->view('admin/basetemplate',$data);
    }

    function approved_comment($comment_id = 0)
    {
        $this->authenticate();

        if(is_numeric($comment_id) && checkUrlParam('news_has_comments', 'id', $comment_id, TRUE))
        {
            $result = $this->News_model->comment_approved($comment_id);
            
            if($result)
            {
                $this->session->set_flashdata('successmsg','Comment Approved');
                redirect('admin/comments');
            }
        }
        else
        {
            show_error('Invalid data');
        }
    }
    
    function reject_comment($comment_id = 0)
    {
        $this->authenticate();

        if(is_numeric($comment_id) && checkUrlParam('news_has_comments', 'id', $comment_id, TRUE))
        {
            $result = $this->News_model->comment_rejected($comment_id);
            
            if($result)
            {
                $this->session->set_flashdata('successmsg','Comment Rejected');
                redirect('admin/comments');
            }
        }
        else
        {
            show_error('Invalid data');
        }
    }
    
    function delete_comment($id = 0)
    {
        if(is_numeric($id) && checkUrlParam('news_has_comments','id',$id))
        {
            $result = $this->News_model->delete_comment($id);
            if($result)
            {
                $this->session->set_flashdata('successmsg','Comment Deleted Successfully.');
                redirect('admin/comments');
            }
            else
            {
                $this->session->set_flashdata('errormsg','Error occuring in deleting comment');
                redirect('admin/comments');
            }
        }
        else
        {
            show_error('Invalid data');
        }   
    }
    
    function advertisement()
    {
        $this->authenticate();

        $this->form_validation->set_rules('email','Email','required|xss_clean|trim');
            
        if($this->form_validation->run())
        {
            require FCPATH.APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php';

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            // $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            // $mail->SMTPAuth = true;                               // Enable SMTP authentication
            // $mail->Username = 'simhasthaujjain16@gmail.com';                 // SMTP username
            // $mail->Password = 'PalashBairagi12345';                           // SMTP password
            $mail->Host = 'hits03.hostitsmart.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'contact@simhasthaonline.in';                 // SMTP username
            $mail->Password = 'sim12345';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $subject = $this->input->post('subject');

            $from = ADMIN_EMAIL;
            $to_email = $this->input->post('email');
            $emails = explode(',', $to_email);

            foreach($emails as $to)
            {
                $mail->setFrom($from, 'Simhastha Ujjain 2016');
                $mail->addAddress($to);               // Name is optional
                $mail->addReplyTo($from, 'Simhastha Ujjain 2016');
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                
                $message = array(
                            'description' => $this->input->post('description'),
                            'link' => base_url().'posts'
                    );
                $email_view = $this->load->view('email/advertisement',$message,TRUE);
            
                $mail->Body    = $email_view;
                
                if(!$mail->send()) {
                    $this->session->set_flashdata('error', $mail->ErrorInfo);
                } else {
                    $this->session->set_flashdata('success', 'Mail successfully sent!');
                }
            }

            redirect('admin/advertisement');
        } 
        else
        {
            $data['header'] = TRUE;
            $data['footer'] = TRUE;
            $data['active']['tab'] = FALSE;
            $data['active']['arrow'] = FALSE;
            $data['active_menu'] = 'send_email';
            $data['_sidebar'] = 'admin/sidebar';
            $data['_view'] = 'admin/advertisement';
            $this->load->view('admin/basetemplate',$data);
        } 
    }
}
