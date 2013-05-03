<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sections extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if(!isset($_SESSION))
        {
            session_start();
        }

        if (!isset($_SESSION['user']))
            redirect(base_url() . 'login');
        if ($_SESSION['user_role'] == '2') {
            redirect(base_url() . 'welcome/neautorizat');
        }
        $this->load->helper(array('form', 'url'));
    }

    function index() {
        $this->load->view('welcome_view');
    }
    function edit_lucrare() {
        $this->db->where('evidenta_lucrari.id', $this->uri->segment('3'));
        $this->db->select('*,grade_clasif.name as grad_clasif,tipuri_exemplar.name as tip_exemplar,
                structuri_emitente.name as structura_emitenta, indici_arh.name as indice, indici_arh.descriere as indice_detail,
                servicii.name as serviciu, lucratori.name as lucrator, stadii.name as stadiu');
        $this->db->from('evidenta_lucrari');
        $this->db->join('grade_clasif', 'grade_clasif.id = evidenta_lucrari.id_grad_clasif', 'left');
        $this->db->join('tipuri_exemplar', 'tipuri_exemplar.id = evidenta_lucrari.id_tip_exemplar', 'left');
        $this->db->join('structuri_emitente', 'structuri_emitente.id = evidenta_lucrari.id_structura_emitenta', 'left');
        $this->db->join('indici_arh', 'indici_arh.id = evidenta_lucrari.id_indice_arhivare', 'left');
        $this->db->join('servicii', 'servicii.id = evidenta_lucrari.id_serv_titular', 'left');
        $this->db->join('lucratori', 'lucratori.id = evidenta_lucrari.id_lucrator_repartizat', 'left');
        $this->db->join('stadii', 'stadii.id = evidenta_lucrari.id_stadiu', 'left');
        //$this->db->join('evidenta_lucrari', 'evidenta_lucrari.id = evidenta_lucrari.id_lucrari_conexate');
        $data['detaliere_lucrare'] = $this->db->get();
        $data['grade_clasificare'] = $this->db->get('grade_clasif');
        $data['tipuri_exemplar'] = $this->db->get('tipuri_exemplar');
        $data['structuri_emitente'] = $this->db->get('structuri_emitente');
        $data['indici_arh'] = $this->db->get('indici_arh');
        $data['servicii'] = $this->db->get('servicii');
        $data['lucratori'] = $this->db->get('lucratori');
        $data['stadii'] = $this->db->get('stadii');
        $data['lucrari'] = $this->db->get('evidenta_lucrari');
        $this->load->view('edit_lucrare_view', $data);
    }

    function add_lucrari() {
        $cod = 'ikansdfj334';
        $this->load->model('mautorizare');
        $this->mautorizare->autorizeaza($cod);
        if ($_POST) {
            $servicii = $this->db->get('servicii');
            $nr_servicii = $servicii->num_rows();
            $servicii_implicate = $_POST['id_serv_titular'];
            for ($i = 1; $i < $nr_servicii; $i++) {
                if ($_POST['id_serviciu_' . $i] != null && $_POST['id_serviciu_' . $i] != $_POST['id_serv_titular']) {
                    $servicii_implicate = $servicii_implicate . '-' . $_POST['id_serviciu_' . $i];
                }
            }

            //
            if ($_POST['id_structura_emitenta'] == '99999') {
                $data = array(
                    'name' => $_POST['structura_emitenta']
                );
                $this->db->insert('structuri_emitente', $data);
                //
                $this->db->where('name', $_POST['structura_emitenta']);
                $structura_emitenta = $this->db->get('structuri_emitente');
                foreach ($structura_emitenta->result() as $rows) {
                    $id = $rows->id;
                }
                $id_structura_emitenta = $id;
            } else {
                $id_structura_emitenta = $_POST['id_structura_emitenta'];
            }
            $data_time_request = date('Y-m-d H:i:s', time());
            $data = array(
                'nr_intern' => $_POST['nr_intern'],
                'data_intrare' => $_POST['data_intrare'],
                'provenienta' => $_POST['provenienta'],
                'id_grad_clasif' => $_POST['id_grad_clasif'],
                'nr_dgcti' => $_POST['nr_dgcti'],
                'data_dgcti' => $_POST['data_dgcti'],
                'id_tip_exemplar' => $_POST['id_tip_exemplar'],
                'id_structura_emitenta' => $id_structura_emitenta,
                'nr_emitere' => $_POST['nr_emitere'],
                'data_emitere' => $_POST['data_emitere'],
                'nr_pagini' => $_POST['nr_pagini'],
                'id_indice_arhivare' => $_POST['id_indice_arhivare'],
                'id_serv_titular' => $_POST['id_serv_titular'],
                'servicii_implicate' => $servicii_implicate,
                'detaliere_lucrare' => $_POST['detaliere_lucrare'],
                'id_lucrator_repartizat' => $_POST['id_lucrator_repartizat'],
                'rezolutionar_intern' => $_POST['rezolutionar_intern'],
                'data_rezolutie' => $_POST['data_rezolutie'],
                'termen' => $_POST['termen'],
                'id_stadiu' => $_POST['id_stadiu'],
                'rezolvare' => $_POST['rezolvare'],
                'data_iesire' => $_POST['data_iesire'],
                'id_lucrari_conexate' => $_POST['id_lucrari_conexate'],
                'vers' => '1',
                'id_user_operator' => $_SESSION['user_id'],
                'data_sistem' => $data_time_request
            );
            $this->db->insert('evidenta_lucrari', $data);
            redirect('sections/cauta_lucrari');
        } else {
            $data['grade_clasificare'] = $this->db->get('grade_clasif');
            $data['tipuri_exemplar'] = $this->db->get('tipuri_exemplar');
            $data['structuri_emitente'] = $this->db->get('structuri_emitente');
            $data['indici_arh'] = $this->db->get('indici_arh');
            $data['servicii'] = $this->db->get('servicii');
            $data['lucratori'] = $this->db->get('lucratori');
            $data['stadii'] = $this->db->get('stadii');
            $data['lucrari'] = $this->db->get('evidenta_lucrari');
            $this->load->view('add_lucrari_view', $data);
        }
    }

    function update_lucrari() {
        if ($_POST) {
            $data_time_request = date('Y-m-d H:i:s', time());
            $data = array(
                'nr_intern' => $_POST['nr_intern'],
                'data_intrare' => $_POST['data_intrare'],
                'provenienta' => $_POST['provenienta'],
                'id_grad_clasif' => $_POST['id_grad_clasif'],
                'nr_dgcti' => $_POST['nr_dgcti'],
                'data_dgcti' => $_POST['data_dgcti'],
                'id_tip_exemplar' => $_POST['id_tip_exemplar'],
                'id_structura_emitenta' => $_POST['id_structura_emitenta'],
                'nr_emitere' => $_POST['nr_emitere'],
                'data_emitere' => $_POST['data_emitere'],
                'nr_pagini' => $_POST['nr_pagini'],
                'id_indice_arhivare' => $_POST['id_indice_arhivare'],
                'id_serv_titular' => $_POST['id_serv_titular'],
                'detaliere_lucrare' => $_POST['detaliere_lucrare'],
                'id_lucrator_repartizat' => $_POST['id_lucrator_repartizat'],
                'rezolutionar_intern' => $_POST['rezolutionar_intern'],
                'data_rezolutie' => $_POST['data_rezolutie'],
                'termen' => $_POST['termen'],
                'id_stadiu' => $_POST['id_stadiu'],
                'rezolvare' => $_POST['rezolvare'],
                'data_iesire' => $_POST['data_iesire'],
                'id_lucrari_conexate' => $_POST['id_lucrari_conexate'],
                'vers' => $_POST['vers'] + 1,
                'id_user_operator' => $_SESSION['user_id'],
                'data_sistem' => $data_time_request
            );
            $this->db->insert('evidenta_lucrari', $data);
            redirect('sections/cauta_lucrari');
        }
    }

}