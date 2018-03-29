<?php
/**
 * Created by PhpStorm.
 * User: Ian Cuninghame
 * Date: 2018-03-20
 * Time: 11:57 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {

    /*

    Called when a user goes to localhost/engi2918/Pages/view/somepagename
    This controller will be used to load static pages including the homepage.

    */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('products_model');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index()
    {
        $products = $this->products_model->fetch_listed();
        $images = array();

        //Load images by SKU id and get current time:
        foreach ($products as $product){

            $images_dir = "assets/items/"."/".$product->SKEW;
            $images[$product->SKEW] = glob($images_dir."/"."*.jpg");

            $currentPrice = $product->Currentprice; //Initially set to current price in the database

            $duration = (strtotime($product->Endtime) - strtotime($product->Starttime))/3600;

            $x = $product->Startingprice;

            $current_time = time();

            $diffdates = ($current_time - strtotime($product->Starttime));

            $z = ($diffdates) / (($product->Intervals)*3600);

            $z = floor($z);

            $time_remaining = $duration - $diffdates/3600;

            $y = $product->Pricechange * ($z);

            $currentPrice = ($x - $y);

            if( round($currentPrice, -3) == $product->Currentprice){



            }else{

                $this->products_model->update_price($product, $currentPrice);
                //called for each product

            }

            //Called for each product, gets the time remaining for each auction
            $data['time_remaining'][$product->SKEW] = round($time_remaining, 2);

        }

        $data['products'] = $products;
        $data['images'] = $images;
        $data['title'] = 'View all Products';
        if($this->is_logged_in())
            $data['logged_in'] = TRUE;

        $this->load->view('header', $data); //Load header + data
        $this->load->view('navbar', $data);
        $this->load->view('pages/products_list' , $data); //Load static page view + data
        $this->load->view('footer', $data); //Load footer + data
    }

    public function view($skew = -1)
    {

        if ($skew <= 0){
            echo ("Error. Invalid product id.");
            anchor(site_url(), "Return to home");
        }else{

            $products = $this->products_model->fetch_products($skew);
            $images = array();

            //Translate query result objects into an array:
            foreach($products as $row){

                $images_dir = "assets/items"."/".$row->SKEW;
                $images[$row->SKEW] = glob($images_dir."/"."*.jpg");
                $data['product']['id'] = $row->SKEW;
                $data['product']['name'] = $row->Name;
                $data['product']['desc'] = $row->Description;
                $data['product']['seller_id'] = $row->Seller_id;
                $data['product']['status'] = $row->Status;
                $data['product']['start_price'] = $row->Startingprice;
                $data['product']['cur_price'] = $row->Currentprice;
                $data['product']['min_price'] = $row->Minimumprice;
                $data['product']['buyer_id'] = $row->Buyer_id;
                $data['product']['cond'] = $row->Conditions;
                $data['product']['interval'] = $row->Intervals;
                $data['product']['pchange'] = $row->Pricechange;
                $data['product']['start'] = $row->Starttime;
                $data['product']['end'] = $row->Endtime;

                $currentPrice = $row->Currentprice; //Initially set to current price in the database

                $duration = (strtotime($row->Endtime) - strtotime($row->Starttime))/3600;

                $x = $row->Startingprice;

                $current_time = time();

                $diffdates = ($current_time - strtotime($row->Starttime));

                $z = ($diffdates) / (($row->Intervals)*3600);

                $z = floor($z);

                $time_remaining = $duration - $diffdates/3600;

                $y = $row->Pricechange * ($z);

                $currentPrice = ($x - $y);

                //echo "Duration:".$duration." Start time: ".strtotime($product->Starttime)." Date difference:".$diffdates." Y:".$y." Interval:".$product->Intervals." Newprice:".$currentPrice."<br/>";

                if( round($currentPrice, -3) == $row->Currentprice){



                }else{

                    $this->products_model->update_price($row, $currentPrice);
                    //called for each product

                }

                $data['product']['time_remaining'] = round($time_remaining, 2);
                $data['product']['cur_price'] = $row->Currentprice; //Make sure current price is current

            }

            $data['title'] = ucfirst($data['product']['name']); //Capitalizes item name and stores it as the title variable for use in Views
            $data['images'] = $images;
            if($this->is_logged_in())
                $data['logged_in'] = TRUE;

            $this->load->view('header', $data); //Load header + data
            $this->load->view('navbar', $data);
            $this->load->view('pages/product_details' , $data); //Load static page view + data
            $this->load->view('footer', $data); //Load footer + data

        }

    }

    //Form page for registering a product:
    public function sell()
    {

        if($this->is_logged_in()){

            $data['products'] = $this->products_model->fetch_products();
            $data['logged_in'] = TRUE;
            $data['title'] = 'View all Products';

            $this->load->view('header', $data); //Load header + data
            $this->load->view('navbar', $data);
            $this->load->view('pages/register_product' , $data); //Load static page view + data
            $this->load->view('footer', $data); //Load footer + data

        }else{

            redirect();

        }


    }

    public function register()
    {

        if($this->is_logged_in()){

            //Get user id of seller
            $userid = $this->auth_user_id;

            // Inputted user data:
            $data = [
                'name'   => $_POST['pname'],
                'desc'     => $_POST['desc'],
                'seller_id'      => NULL, //ID of the signed in user making the request
                'status' => 'L',
                "start_price" => $_POST['start_price'],
                "cur_price" => $_POST['start_price'],
                "min_price" => $_POST['min_price'],
                "buyer_id" => NULL, //Will be null until buyer makes a bid
                "condition" => $_POST['condition'],
                "interval" => $_POST['intervals'],
                "pricechange" => ($_POST['start_price'] - $_POST['min_price']) * ($_POST['intervals'] / ($_POST['duration'])),
                "time_start" => date("Y-m-d H:m:s", time()), //Current timestam
                "time_end" => date("Y-m-d H:m:s", time() + (3600 * $_POST['duration'])),
            ];


            if($this->products_model->register_product($data, $userid)){
                echo ("Product Registration completed");
                echo $data['pricechange'];
            }else{
                echo ("An error occurred while registering your product.<br />");
                echo anchor(site_url("pages/view"), "Return to home");
            };

        }else{
            redirect();
        }


    }

    public function buy($skew = NULL)
    {

        if($this->is_logged_in()){

            if(!is_null($skew)){

                $products = $this->products_model->fetch_products($skew);

                //Convert product result into array
                foreach($products as $product){

                    $data['product']['id'] = $product->SKEW;
                    $data['product']['name'] = $product->Name;
                    $data['product']['desc'] = $product->Description;
                    $data['product']['seller_id'] = $product->Seller_id;
                    $data['product']['status'] = $product->Status;
                    $data['product']['start_price'] = $product->Startingprice;
                    $data['product']['cur_price'] = $product->Currentprice;
                    $data['product']['min_price'] = $product->Minimumprice;
                    $data['product']['buyer_id'] = $product->Buyer_id;
                    $data['product']['cond'] = $product->Conditions;
                    $data['product']['interval'] = $product->Intervals;
                    $data['product']['pchange'] = $product->Pricechange;
                    $data['product']['start'] = $product->Starttime;
                    $data['product']['end'] = $product->Endtime;

                }

                $data['title'] = ucfirst($data['product']['name']); //Capitalizes item name and stores it as the title variable for use in Views
                if($this->is_logged_in())
                    $data['logged_in'] = TRUE;
                $this->load->view('header', $data); //Load header + data
                $this->load->view('navbar', $data);
                $this->load->view('pages/final_payment' , $data); //Load static page view + data
                $this->load->view('footer', $data); //Load footer + data

            }else{

                redirect('products');

            }

        }else{

            echo ("You must be logged in to do that.");
            echo anchor("Return to home", site_url());

        }




    }

    public function reserve_product($skew = NULL){

        if($this->is_logged_in()){

            $userid = $this->auth_user_id;
            $data['logged_in'] = TRUE;

            if(!is_null($skew)){

                if($this->products_model->reserve_product($skew, $userid)){

                    echo ("Auction won! Your product will be shipped to you shortly.");
                    echo anchor("Return to home", site_url());

                }else{

                    echo ("An error occurred while reserving your product. Noooooo!");
                    echo anchor("Return to home", site_url());

                }

            }

        }else{

            echo ("You must be logged in to do that.");
            echo anchor("Return to home", site_url());

        }

    }

    public function my_auctions(){

        if($this->is_logged_in()){

            $userid = $this->auth_user_id;
            $data['logged_in'] = TRUE;

            $products = $this->products_model->fetch_seller_auctions($userid);

            foreach($products as $row){

                $duration = (strtotime($row->Endtime) - strtotime($row->Starttime))/3600;

                $x = $row->Startingprice;

                $current_time = time();

                $diffdates = ($current_time - strtotime($row->Starttime));

                $z = ($diffdates) / (($row->Intervals)*3600);

                $z = floor($z);

                $time_remaining = $duration - $diffdates/3600;

                $data['time_remaining'][$row->SKEW] = round($time_remaining, 2);

            }

            $data['products'] = $products;

            $this->load->view('header', $data); //Load header + data
            $this->load->view('navbar', $data);
            $this->load->view('pages/my_auctions' , $data); //Load static page view + data
            $this->load->view('footer', $data); //Load footer + data

        }



    }

    public function my_purchases(){

        if($this->is_logged_in()){

            $userid = $this->auth_user_id;
            $data['logged_in'] = TRUE;

            $products = $this->products_model->fetch_buyer_auctions($userid);

            foreach($products as $row){

                $images_dir = "assets/items/"."/".$row->SKEW;
                $images[$row->SKEW] = glob($images_dir."/"."*.jpg");

            }

            $data['products'] = $products;
            $data['images'] = $images;

            $this->load->view('header', $data); //Load header + data
            $this->load->view('navbar', $data);
            $this->load->view('pages/my_purchases' , $data); //Load static page view + data
            $this->load->view('footer', $data); //Load footer + data

        }



    }

    public function unlist($id){

        if($this->is_logged_in()){

            $userid = $this->auth_user_id;

            //$this->products_model->fetch_seller_auctions($userid);

            if($this->products_model->unlist_product($id, $userid)){

                echo ("Item unlisted successfully.");
                anchor("Return to your auctions.", site_url('products/my_auctions'));

            }

        }else{

            redirect();
        }


    }



}

?>
