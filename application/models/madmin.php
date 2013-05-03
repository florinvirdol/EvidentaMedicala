<?php

class Madmin extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function login($id_lucratori) {
        $this->db->where('email', $_POST['User']);
        $this->db->where('password', md5($_POST['Password']));
        $query = $this->db->get('users');
        $result = $query->num_rows();
        return $result;
    }

    function get_nomenclator($table) {
        $query = $this->db->get($table);
        return $query->result();
    }

    function add_nomenclator($_POST) {
        $data = array();
        $table = $_POST['table'];
        $query = $this->db->get($table);
        foreach ($query->list_fields() as $field) {
            if ($field != 'id')
                $data[$field] = $_POST[$field];
        }
        $this->db->insert($table, $data);
    }

    function get_nomenclator_item($table, $id) {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->result();
    }

    function delete_nomenclator_item($table, $id) {
        $this->db->where('id', $id);
        $query = $this->db->delete($table);
    }

    function update_nomenclator() {
        $data = array();
        $table = $_POST['table'];
        $query = $this->db->get($table);
        foreach ($query->list_fields() as $field) {
            if ($field != 'id')
                $data[$field] = $_POST[$field];
        }
        $this->db->where('id', $_POST['id']);
        $this->db->update($table, $data);
    }

    function update_acces($_POST) {
        print_r($_POST);
        foreach ($_POST as $key => $value) {
            list($cod_f, $id_role) = explode("-", $key);
            $this->db->where('cod_functie', $cod_f);
            $this->db->where('id_user', $id_role);
            //$this->db->where('status', '2'); //status activ
            $query = $this->db->get('access');
            $num_result = $query->num_rows();
            if ($num_result > 0) {
                if ($value == 'nepermis') {
                    $data_time_request = date('Y-m-d H:i:s', time());
                    $datab = array(
                        'status' => '1',
                        'time' => $data_time_request
                    );
                    $this->db->where('cod_functie', $cod_f);
                    $this->db->where('id_user', $id_role);
                    $this->db->update('access', $datab);
                } elseif ($num_result > 0) {
                    $data_time_request = date('Y-m-d H:i:s', time());
                    $datab = array(
                        'status' => '2',
                        'time' => $data_time_request
                    );
                    $this->db->where('cod_functie', $cod_f);
                    $this->db->where('id_user', $id_role);
                    $this->db->update('access', $datab);
                }
            } else {
                $data_time_request = date('Y-m-d H:i:s', time());
                $data = array(
                    'id_user' => $id_role,
                    'cod_functie' => $cod_f,
                    'status' => '2',
                    'time' => $data_time_request
                );
                $this->db->insert('access', $data);
            }
            //echo $key.'-'.$value;
        }
    }

    function get_users() {
        $this->db->select('users.id as id_user, lucratori.name as nume,status_users.status as status_user,status_users.color as status_color , servicii.name as nume_serviciu, users.email as email, roles.name as rol');
        $this->db->from('users');
        $this->db->join('lucratori', 'lucratori.user_id = users.id', 'left');
        $this->db->join('servicii', 'servicii.id = lucratori.id_serv', 'left');
        $this->db->join('roles', 'roles.id = users.role', 'left');
        $this->db->join('status_users', 'status_users.id = users.id_status', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    function get_user($id_user) {
        $this->db->where('users.id', $id_user);
        $this->db->select('users.id as id_user, lucratori.name as nume, servicii.id as id_serviciu,
            roles.id as id_rol, status_users.id as id_status_user');
        $this->db->from('users');
        $this->db->join('lucratori', 'lucratori.user_id = users.id', 'left');
        $this->db->join('servicii', 'servicii.id = lucratori.id_serv', 'left');
        $this->db->join('roles', 'roles.id = users.role', 'left');
        $this->db->join('status_users', 'status_users.id = users.id_status', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    function update_user($_POST) {
        $id_user = $_POST['id_user'];
        $id_serv = $_POST['serviciu'];
        $id_role = $_POST['role'];
        $id_status = $_POST['status'];
        $datab = array( 'role' => $id_role, 'id_status' => $id_status);
        $this->db->where('id', $id_user);
        $this->db->update('users', $datab);
        
        $data = array( 'id_serv' => $id_serv);
        $this->db->where('user_id', $id_user);
        $this->db->update('lucratori', $data);
    }

}

?>
