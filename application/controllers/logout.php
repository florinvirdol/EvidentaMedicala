<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if(!isset($_SESSION))
        {
            session_start();
        }

        //if(!isset($_SESSION['user'])) redirect(base_url().'admin/welcome');
        // Your own constructor code
    }

    public function index() {
        session_destroy();
        redirect('login');
    }

}

?>