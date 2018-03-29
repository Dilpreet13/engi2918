<?php

/**
 * Created by PhpStorm.
 * User: Ian Cuninghame
 * Date: 2018-03-22
 * Time: 8:25 PM
 */
class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->helper('url_helper');
        $data['logged_in'] = FALSE;
        if($this->is_logged_in())
            $data['logged_in'] = TRUE;
    }

    public function login()
    {
        $data['logged_in'] = FALSE;
        if($this->is_logged_in())
            redirect();

        //Method should not be directly accessible
        if( $this->uri->uri_string() == 'user/login')
            show_404();

        if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )
            $this->require_min_level(1);

        $this->setup_login_form();

        $html = $this->load->view('header', '', TRUE); //Load header + data
        $html .= $this->load->view('navbar', '', TRUE); //Load navbar + data
        $html .= $this->load->view('pages/login', '', TRUE); //Load static page view + data
        $html .= $this->load->view('footer', '', TRUE); //Load footer + data

        echo $html;

    }

    public function logout()
    {
        if($this->is_logged_in()){

            $this->authentication->logout();

        }

        // Set redirect protocol
        $redirect_protocol = USE_SSL ? 'https' : NULL;

        redirect( site_url( LOGIN_PAGE . '?' . AUTH_LOGOUT_PARAM . '=1', $redirect_protocol ) );
    }

}