<?php
/**
 * Created by PhpStorm.
 * User: Ian Cuninghame
 * Date: 2018-03-22
 * Time: 9:43 PM
 */
class Products_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function fetch_products($skew = NULL){

        //Fetch all items if no SKEW specified:
        if(is_null($skew)){
            $query = $this->db->query("SELECT * FROM products");
        }
        //Fetch a specific item:
        else{
            $query = $this->db->query("SELECT * FROM products WHERE products.SKEW LIKE '$skew'");
        }

        return $query->result();

    }

    public function fetch_seller_auctions($userid = NULL){

        //Fetch all items if no SKEW specified:
        if(is_null($userid)){

            redirect();

        }
        //Fetch a specific item:
        else{
            $query = $this->db->query("SELECT * FROM products WHERE products.Seller_id LIKE '$userid' AND products.Status LIKE 'L'");
        }

        return $query->result();

    }

    public function fetch_buyer_auctions($userid = NULL){

        //Fetch all items if no SKEW specified:
        if(is_null($userid)){

            redirect();

        }
        //Fetch a specific item:
        else{
            $query = $this->db->query("SELECT * FROM products WHERE products.Buyer_id LIKE '$userid'");
        }

        return $query->result();

    }

    public function fetch_listed($skew = NULL){

        //Fetch all items if no SKEW specified:
        if(is_null($skew)){
            $query = $this->db->query("SELECT * FROM products WHERE products.Status = 'L'");
        }
        //Fetch a specific item:
        else{
            $query = $this->db->query("SELECT * FROM products WHERE products.SKEW LIKE '$skew'");
        }

        return $query->result();

    }

    public function register_product($data = NULL, $userid = NULL){

        if(is_null($data) || is_null($userid)){

            return FALSE;

            redirect();

        }else{

            //Store product info in the products table:
            $query = $this->db->query("INSERT INTO products (SKEW, Name, Description, Seller_id, Status, Startingprice, Currentprice, Minimumprice, Buyer_id, Conditions, Intervals, Pricechange, Starttime, Endtime)
                    VALUES (NULL, '$data[name]', '$data[desc]', '$userid', '$data[status]', '$data[start_price]', '$data[cur_price]', '$data[min_price]', 'NULL', '$data[condition]', '$data[interval]', '$data[pricechange]', '$data[time_start]', '$data[time_end]')  ");

            return TRUE;

        }

    }

    public function update_price($product, $newprice){

        if(!is_null($product) && !is_null($newprice)){

            $query = $this->db->query("UPDATE products SET Currentprice = '$newprice' WHERE products.SKEW = '$product->SKEW'");

            return TRUE;

        }

        return FALSE;


    }

    public function reserve_product($id = NULL, $userid = NULL){

        if(!is_null($id)){

            if ($query = $this->db->query("SELECT * FROM products WHERE products.SKEW LIKE '$id'")){

                $query1 = $this->db->query("UPDATE products SET products.Status = 'R' WHERE products.SKEW LIKE '$id'");
                $query2 = $this->db->query("UPDATE products SET products.Buyer_id = '$userid' WHERE products.SKEW LIKE '$id'");

                return TRUE;

            }

            return FALSE;

        }

    }

    public function unlist_product($id = NULL, $userid = NULL){

        if(!is_null($id) && $id > 0){

            if(!is_null($userid) && $userid > 0){

                $query1 = $this->db->query("UPDATE products SET products.Status = 'N' WHERE products.Seller_id LIKE '$userid'");

                return TRUE;

            }


            return FALSE;

        }

        return FALSE;

    }


}

