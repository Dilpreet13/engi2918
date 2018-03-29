<?php
/**
 * Created by PhpStorm.
 * User: Ian Cuninghame
 * Date: 2018-03-19
 * Time: 5:49 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {

    /*

    Called when a user goes to localhost/engi2918/Pages/view/somepagename
    This controller will be used to load static pages including the homepage.

    */

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function view($page = 'home')
    {

        $data['logged_in'] = FALSE;
        if($this->is_logged_in())
            $data['logged_in'] = TRUE;

        $data['title'] = ucfirst($page); //Capitalizes page name and stores it as the title variable for use in Views

        $this->load->view('header', $data); //Load header + data
        $this->load->view('navbar', $data); //Load navbar + data
        $this->load->view('pages/'.$page , $data); //Load static page view + data
        $this->load->view('footer', $data); //Load footer + data
    }


}

?>
