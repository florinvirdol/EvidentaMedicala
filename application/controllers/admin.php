<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] != 'autentificat')
            redirect(base_url() . 'admin_login/login');
        $this->load->helper(array('form', 'url'));
    }

    function index() {
        $this->load->view('admin_view');
    }

    function get_nomenclator() {
        $table = $this->uri->segment('3');
        $this->load->model('madmin');
        $data['table'] = $table;
        $data['result'] = $this->madmin->get_nomenclator($table);
        $this->load->view('nomenclator_view', $data);
    }

    function nomenclatoare() {
        $this->load->view('admin_view');
    }

    function add_nomenclator() {
        if ($_POST) {
            $this->load->model('madmin');
            $data['result'] = $this->madmin->add_nomenclator($_POST);
            redirect(base_url() . 'admin/get_nomenclator/' . $_POST['table']);
        } else {
            $data['table'] = $this->uri->segment('3');
            $this->load->model('madmin');
            $data['result'] = $this->madmin->get_nomenclator($data['table']);
            $this->load->view('add_nomenclatoare_view', $data);
        }
    }

    function edit_nomenclator() {
        if ($_POST) {
            $this->load->model('madmin');
            $data['result'] = $this->madmin->update_nomenclator($_POST);
            redirect(base_url() . 'admin/get_nomenclator/' . $_POST['table']);
        } else {
            $data['table'] = $this->uri->segment('3');
            $id = $this->uri->segment('4');
            $data['id'] = $id;
            $this->load->model('madmin');
            $data['result'] = $this->madmin->get_nomenclator_item($data['table'], $id);
            $this->load->view('edit_nomenclatoare_view', $data);
        }
    }

    function detele_nomenclator_item() {
        $data['table'] = $this->uri->segment('3');
        $id = $this->uri->segment('4');
        $this->load->model('madmin');
        $data['result'] = $this->madmin->delete_nomenclator_item($data['table'], $id);
        redirect(base_url() . 'admin/get_nomenclator/' . $data['table']);
    }

    function acces() {
        $data['roluri'] = $this->db->get('roles');
        $data['functionalitati'] = $this->db->get('functionalitati');
        $this->load->view('access_view', $data);
    }

    function update_acces() {
        $this->load->model('madmin');
        $this->madmin->update_acces($_POST);
        redirect(base_url() . 'admin/acces');
    }

    function users() {
        $this->load->model('madmin');
        $data['query'] = $this->madmin->get_users();
        $this->load->view('users_view', $data);
    }

    function edit_users() {
        if ($_POST) {
            $this->load->model('madmin');
            $data['query'] = $this->madmin->update_user($_POST);    
            redirect(base_url().'admin/users');
        } else {
            $id_user = $this->uri->segment('3');
            $this->load->model('madmin');
            $data['query'] = $this->madmin->get_user($id_user);
            $data['servicii'] = $this->db->get('servicii');
            $data['status_users'] = $this->db->get('status_users');
            $data['roles'] = $this->db->get('roles');
            $this->load->view('user_view', $data);
        }
    }

}