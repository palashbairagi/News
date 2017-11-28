<?php

class BaseController extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Page_model');
        
        // if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'] > 0 && !$this->session->userdata('user_id'))
        // {
        //     $result = $this->Page_model->get_user_by_id($_COOKIE['user_id']);

        //     $this->session->set_userdata('user_id',$result['id']);
        //     $this->session->set_userdata('email',$result['email']);
        //     $this->session->set_userdata('username',$result['firstname'].' '.$result['lastname']);
        // }

        // if($this->session->userdata('user_id'))
        // {
        //     $this->user['id'] = $this->session->userdata('user_id');
            
        // }
// pr($_SERVER);exit;
        
    }
    
    function is_ajax()
    {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
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
            // TODO: solve problem of cascading appending of redirect uris to the string
            // user isnt logged in. store the referrer URL in a var.
            if(isset($_SERVER['HTTP_REFERER']))
            {
                $redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
            }
            else
            {
                $redirect_to = $this->uri->uri_string();
            }            

            redirect('user/login?redirect='.$redirect_to);
            exit;
        }
    }
    
    function is_logged_in()
    {
        if($this->session->userdata('user_id') > 0)
            return TRUE;
        else
            return FALSE;
    }
}

?>
