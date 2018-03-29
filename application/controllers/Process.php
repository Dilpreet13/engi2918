<?php
/**
 * Created by PhpStorm.
 * User: Ian Cuninghame
 * Date: 2018-03-19
 * Time: 5:49 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends MY_Controller {

    /*

    Called when a user goes to localhost/engi2918/Pages/view/somepagename
    This controller will be used to load static pages including the homepage.

    */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->helper('url_helper');
    }

    public function registration()
    {

        // Inputted user data:
        $userdata = [
            "user_type" => $_POST['user_type'],
            'username'   => $_POST['email'],
            'passwd'     => $this->authentication->hash_passwd($_POST['password']),
            'email'      => $_POST['email'],
            'auth_level' => '1',
            "firstname" => $_POST['firstname'],
            "lastname" => $_POST['lastname'],
            "address" => $_POST['address'],
            "paypal" => $_POST['paypal'],
            "trust" => 5
        ];

        if($this->users_model->register_user($userdata)){
            echo ("Registration completed");
            redirect("Pages/view/");
        }else{
            echo ("An error occurred during registration. The email is already in use. <br />");
            echo anchor(site_url("pages/view"), "Return to home");
        };

    }


}

?>
