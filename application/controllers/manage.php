<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if(!isset($_SESSION))
        {
            session_start();
        }

        if (!isset($_SESSION['user']))
            redirect(base_url() . 'login');
        if ($_SESSION['user_role'] != '3')
            redirect(base_url() . 'welcome/neautorizat');
        $this->load->helper(array('form', 'url'));
    }

    function index() {
        $this->db->where('id', $_SESSION['serviciu']);
        $data['serviciu'] = $this->db->get('servicii');
        $this->db->where('id_serv_titular', $_SESSION['serviciu']);
        $data['lucrari'] = $this->db->get('evidenta_lucrari');
        $data['nr_rezultate'] = $data['lucrari']->num_rows();
        $this->load->view('manage_welcome_view', $data);
    }

}