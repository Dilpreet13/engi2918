<?php
class Users_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_users($userid = NULL)
    {
        //If no userid argument is given, return all users:
        if ($userid === NULL)
        {
            $query = $this->db->get('users');
            return $query->result_array();
        }

        //If a userid is given, get that user
        $query = $this->db->get_where('users', array('userid' => $userid));
        return $query->row_array();
    }

    public function get_unused_id()
    {
        // Create a random user id between 1200 and 4294967295
        $random_unique_int = 2147483648 + mt_rand( -2147482448, 2147483647 );


        // Make sure the random user_id isn't already in use
        //$query = $this->db->query("SELECT * FROM users,customers AS UC WHERE UC.user_id = ($random_unique_int)");
        $query = $this->db->where( 'user_id', $random_unique_int )->get_where( $this->db_table('user_table') );

        if( $query->num_rows() > 0 )
        {
            $query->free_result();

            // If the random user_id is already in use, try again
            return ($this->get_unused_id());

        }else{

            return $random_unique_int;

        }



    }

    public function check_unique_email($userdata)
    {

        // Make sure the random user_id isn't already in use
        $query = $this->db->query("SELECT * FROM users WHERE users.email LIKE '$userdata[email]'");

        if( $query->num_rows() > 0 )
        {
            $query->free_result();

            // If the random user_id is already in use, return false
            return TRUE;

        }else{
            return FALSE;
        }



    }


    public function register_user($userdata){

        if(is_null($userdata)){

            return FALSE;

        }else if ($this->check_unique_email($userdata)){

            $userdata['created_on'] = date('Y-m-d H:i:s');
            return FALSE;

        } else{

            $userid = $this->get_unused_id();
            $userdata['created_on'] = date('Y-m-d H:i:s');
            //Store user info in Community Auth users table:
            $query1 = $this->db->query("INSERT INTO users (user_id, username, email, auth_level, banned, passwd, passwd_recovery_code, passwd_recovery_date, passwd_modified_at, last_login, created_at, modified_at) VALUE ('$userid','$userdata[email]', '$userdata[email]', '9','0','$userdata[passwd]', 'NULL', 'NULL', 'NULL', 'NULL', '$userdata[created_on]', '$userdata[created_on]' )");
            //Store user info in customer info table:
            $query2 = $this->db->query("INSERT INTO customers (user_id, usertype, email, firstname, lastname, address, paypal, trust) VALUE ('$userid', '$userdata[user_type]','$userdata[email]', '$userdata[firstname]', '$userdata[lastname]', '$userdata[address]', '$userdata[paypal]', '5' )");
            return TRUE;

        }

    }

}

