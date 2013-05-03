<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION)) {
            session_start();
        }

        /*  if (!isset($_SESSION['user_id']))
          redirect(base_url() . 'login'); */
        $this->load->helper(array('form', 'url'));
    }

    function login() {
        if ($_POST) {
            if ($_POST['User'] == null || $_POST['Password'] == null) {
                $data['msg3'] = '<p style="color:red;">Completati credentiale!</p>';
                $this->load->view('admin_login_view', $data);
            } else {
                $this->load->model('madmin');
                $result = $this->madmin->login($_POST);
                if ($result > 0) {
                    $_SESSION['admin_login'] = 'autentificat';
                    redirect('admin');
                } else {
                    $data['msg3'] = '<p style="color:red;">Credentiale incorecte!</p>';
                    $this->load->view('admin_login_view', $data);
                }
            }
        } else {
            $this->load->view('admin_login_view');
        }
    }

}