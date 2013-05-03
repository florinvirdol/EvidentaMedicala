<?php

class Lucrarimodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function lucrari_serviciu($nerepartizate = null, $repartizate = null, $id_lucrator = null) {
        //Secretariat - serviciu?
        $id_serv = $_SESSION['serviciu'];

        $this->db->where('id_serv_titular', $id_serv);

        if ($nerepartizate) {
            $this->db->where('id_lucrator_repartizat', 99999);
        }
//        else
//        {
        if ($repartizate) {
            $this->db->where('id_lucrator_repartizat !=', 99999);
        }
        if ($id_lucrator) {
            $this->db->where('id_lucrator_repartizat', $id_lucrator);
        }
//        }

        $this->db->order_by("id_status_citire", "asc");
        $this->db->order_by("data_sistem", "desc");
        $this->db->select('*, evidenta_lucrari.id as id,
                            structuri_emitente.name as structura_emitenta,
                            lucratori.name as lucrator, lucratori.id as id_lucrator');
        $this->db->from('evidenta_lucrari');
        $this->db->join('structuri_emitente', 'structuri_emitente.id = evidenta_lucrari.id_structura_emitenta', 'left');
        $this->db->join('lucratori', 'lucratori.id = evidenta_lucrari.id_lucrator_repartizat', 'left');
        //$this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    function get_lucrare_detail_by_nr($nr_intern, $data_nr_intern) {
        $this->db->select('id');
        $this->db->where('nr_intern',$nr_intern);
        $this->db->where('data_intrare',$data_nr_intern);
        $id_lucrare = $this->db->get('evidenta_lucrari')->row(0)->id;
        redirect(base_url().'lucrari/detaliere_lucrare/'.$id_lucrare);
    }

    function get_lucrari_relationate($nr_intern) {
        //$this->db->where('id !=', 'NULL');
        $this->db->where('nr_intern_lucrare_secundara', $nr_intern);
        $this->db->or_where('nr_intern_lucrare_principala', $nr_intern);
        $q = $this->db->get('lucrari_relationate');
        return $q;
    }

    function lucrari_personale() {
        $lucrari_full = array();

        $this->db->order_by("id_status_citire", "asc");
        $this->db->order_by("data_sistem", "desc");
        $this->db->select('*, evidenta_lucrari.id as id,
                            structuri_emitente.name as structura_emitenta,
                            lucratori.name as lucrator, lucratori.id as id_lucrator');
        $this->db->from('evidenta_lucrari');
        $this->db->join('structuri_emitente', 'structuri_emitente.id = evidenta_lucrari.id_structura_emitenta', 'left');
        $this->db->join('lucratori', 'lucratori.id = evidenta_lucrari.id_lucrator_repartizat', 'left');

//        $query = $this->db->get();

        $lucrari_rows = $this->db->get()->result();

        foreach ($lucrari_rows as $lucrare_r) {
            if (($lucrare_r->id_lucrator_repartizat == $_SESSION['id_lucrator']) || in_array($_SESSION['id_lucrator'], explode('-', $lucrare_r->lucratori_implicati))) {
                array_push($lucrari_full, $lucrare_r);
            }
        }

        return $lucrari_full;
    }

    function cauta_lucrare() {
        if ($_POST['group1'] == "numar") {
            $this->db->where($_POST['tip_numar_cautare'], $_POST['nr_cautare']);
        } elseif ($_POST['group1'] == "structura_emitenta") {
            if ($_POST['detaliere_lucrare'] != null) {
                $this->db->like('detaliere_lucrare', $_POST['detaliere_lucrare']);
            }
            $this->db->where('id_structura_emitenta', $_POST['id_structura_emitenta']);
        }

        //??irina e secretariat cu acces la lucrari personale,
        //sau e lucrator cu drepturi de secretariat, adica atunci cand cauta o face prin toate lucrarile??
        if ($_SESSION['user_role'] == '2')
            $this->db->where('id_lucrator_repartizat', $_SESSION['id_lucrator']);

        $this->db->order_by("data_sistem", "desc");
        $this->db->select('* ,evidenta_lucrari.id as id,structuri_emitente.name as structura_emitenta, lucratori.name as lucrator, lucratori.id as id_lucrator');
        $this->db->from('evidenta_lucrari');
        $this->db->join('structuri_emitente', 'structuri_emitente.id = evidenta_lucrari.id_structura_emitenta', 'left');
        $this->db->join('lucratori', 'lucratori.id = evidenta_lucrari.id_lucrator_repartizat', 'left');
        $query = $this->db->get();

//        print_r($query->result()->row(0)->id);
//        die();

        return $query->result();
    }

    function detaliere_lucrare($id_lucrare, $citire = null)
    {
//        depinde de unde se apeleaza functia asta!!! , cu un flag, in fct de :
//        din click->    sau din redirect add->..      sau din mail->

        if ($citire == "c")
        {
//            die(print($_SESSION['user_id']));


            //1. update doar 1 sg data, la prima accesare!!!    ?ok    => where(status=1   <=> nu a fost accesata

            $data_time_request = date('Y-m-d H:i:s', time());
            $status_citire =  2;

            //2. update asta doar de titular!!!

            $status_citire_data = array(
                'id_status_citire' => $status_citire,
                'time_citire' => $data_time_request
            );

            //??daca nu gaseste sa update,

            $this->db->where('id', $id_lucrare);
            $this->db->where('id_status_citire', 1);

            //2. ??   // ???? daca nu e titluar, nu o sa gaseaca, da eroare, sau nu updateaza nimic???!??!
            $this->db->where('id_lucrator_repartizat', $_SESSION['id_lucrator']);

            $this->db->update('evidenta_lucrari', $status_citire_data);
//            $this->db->where(array('id', $id_lucrare))->update('evidenta_lucrari', $status_citire_data);

            //3. update de implicati!

            $status_citire_implicati_data = array(
                'status' => $status_citire,
                'time_citire' => $data_time_request
            );
            $this->db->where('id_lucrare', $id_lucrare);

            //3. ??  ?OK
            $this->db->where('id_lucrator_implicat', $_SESSION['id_lucrator']);

            $this->db->where('status', 1);
            $this->db->update('status_citire_lucrari_implicati', $status_citire_implicati_data);
        }

        $this->db->where('evidenta_lucrari.id', $id_lucrare);

        $this->db->select('*,
                evidenta_lucrari.id as id_lucrare, evidenta_lucrari.servicii_implicate as servicii_implicate, evidenta_lucrari.lucratori_implicati as id_lucratori_implicati,
                indici_arh.name as indice, indici_arh.descriere as indice_detail, servicii.name as serviciu,
                grade_clasif.name as grad_clasif, tipuri_exemplar.name as tip_exemplar,
                lucratori.name as lucrator, lucratori.id as id_lucrator,
                structuri_emitente.name as structura_emitenta');

        $this->db->from('evidenta_lucrari');

        $this->db->join('grade_clasif', 'grade_clasif.id = evidenta_lucrari.id_grad_clasif', 'left');

        $this->db->join('tipuri_exemplar', 'tipuri_exemplar.id = evidenta_lucrari.id_tip_exemplar', 'left');
        $this->db->join('structuri_emitente', 'structuri_emitente.id = evidenta_lucrari.id_structura_emitenta', 'left');
        $this->db->join('indici_arh', 'indici_arh.id = evidenta_lucrari.id_indice_arhivare', 'left');
        $this->db->join('servicii', 'servicii.id = evidenta_lucrari.id_serv_titular', 'left');
        $this->db->join('lucratori', 'lucratori.id = evidenta_lucrari.id_lucrator_repartizat', 'left');
        // $this->db->join('stadii', 'stadii.id = evidenta_lucrari.id_stadiu', 'left');
        $query = $this->db->get();

        $query->result();

        return $query->result();
    }

    function repartizeaza_lucrare($id) {
        $data_time_request = date('Y-m-d H:i:s', time());

        $name_rezolutionar_intern = $this->usermodel->getNames($_SESSION['id_lucrator'], "lucratori");
        $name_rezolutionar_intern = $name_rezolutionar_intern[0]->name;

        $data = array(
            'id_lucrator_repartizat' => $_POST['id_lucrator_repartizat'],
            'lucratori_implicati' => $_POST['lucratori_implicati'],
            'termen' => $_POST['termen'],
            'id_user_operator' => $_SESSION['user_id'],
            'data_sistem' => $data_time_request,
            //
            'data_rezolutie' => $data_time_request,
            'rezolutionar_intern' => $name_rezolutionar_intern,
        );

        $this->db->where('id', $id);
        $this->db->update('evidenta_lucrari', $data);

        $evidenta_lucrari_obj = $this->db->select('nr_intern, data_intrare')->from('evidenta_lucrari')->where('id', $id)->get()->row(0);

        $maxVers_obj = $this->db->select_max('versiune', 'maxVers')->from('versiuni')->where('nr_intern', ($evidenta_lucrari_obj->nr_intern . "/" . $evidenta_lucrari_obj->data_intrare))->get()->row(0);
        $new_version = $maxVers_obj->maxVers + 1;

        //TODO:2 functie pt add vers!!
        $vers_data = array(
            'nr_intern' => $evidenta_lucrari_obj->nr_intern . '/' . $evidenta_lucrari_obj->data_intrare,
            //manual ->la lucrator, da??
            'id_stadiu' => 2,
            'rezolvare' => $_POST['comentariu'],
            'versiune' => $new_version,
            'data_operare' => $data_time_request
        );
        $this->db->insert('versiuni', $vers_data);
    }

    function _ifExists($nr_intern)
    {
        $result = $this->db->select('id')->from('evidenta_lucrari')->where('nr_intern', $nr_intern)->get()->row(0);

        return (!empty($result) ? true : false);
    }

    //???
    public function getLucrareNrIntern($id_lucrare)
    {
        $lucrare_obj_result = $this->db->select('nr_intern')->from('evidenta_lucrari')->where('id', $id_lucrare)->limit(1)->get()->row(0);

        $nr_intern = isset($lucrare_obj_result) ? $lucrare_obj_result->nr_intern : null;

        return $nr_intern;
    }

    function add_status_citire_implicati($ids_implicati, $id_lucrare)
    {
        if (strpos($ids_implicati, '-') === false)
        {
            //e doar titularul => nu adauga in tabel status__implicati
        }
        else
        {
            //titular + implicati!

            //primul o sa fie titularul
            $array_ids = array_filter(explode('-', $ids_implicati, 2));

            //?? daca e doar titular- => [0 / 1] = ??
            $array_ids_implicati = array_filter(explode('-', $array_ids[1]));
            foreach ($array_ids_implicati as $id_implicat)
            {
                $data = array(
                    'id_lucrare' => $id_lucrare,
                    'id_lucrator_implicat' => $id_implicat
//                    'status' => //implicit = 1
                );
                $this->db->insert('status_citire_lucrari_implicati', $data);
                //nu am de ce sa verific daca mai e inserted. ca am validarea js pt unic nr_intern!
            }
        }
    }

    function adauga_lucrare()
    {
        //?????CACAT!:  am impresia ca atunci cand e si titular, si in colaborare.. :-?
//        stadiu???   lucrat_implicati?????     data ??   termen???


        $data_time_request = date('Y-m-d H:i:s', time());
        $nr_intern = $_POST['nr_intern'];

        if ($_SESSION['user_role'] == '1') {
            $id_lucrator = $_POST['id_lucrator_repartizat'];
        } else {
            $id_lucrator = $_SESSION['id_lucrator'];
        }

        $data = array(
            'nr_intern' => $nr_intern,
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
            'servicii_implicate' => $_POST['servicii_implicate'],
            'detaliere_lucrare' => $_POST['detaliere_lucrare'],
            'id_lucrator_repartizat' => $id_lucrator,
            'lucratori_implicati' => $_POST['lucratori_implicati'],
            'rezolutionar_intern' => $_POST['rezolutionar_intern'],
            'data_rezolutie' => $_POST['data_rezolutie'],
            'termen' => $_POST['termen'],
            'id_user_operator' => $_SESSION['user_id'],
            'data_sistem' => $data_time_request,
            'id_status_citire' => '1',
        );
        $this->db->insert('evidenta_lucrari', $data);


        $vers_data = array(
            'nr_intern' => $_POST['nr_intern'] . '/' . $_POST['data_intrare'],
            'id_stadiu' => $_POST['id_stadiu'],
            //??la adaugare, nu are rezolvare, nu? sau punem detalierea? ??
//            'rezolvare' => $_POST['rezolvare'],
            'versiune' => '1',
            'data_operare' => $data_time_request
        );
        $this->db->insert('versiuni', $vers_data);


        $id = $this->db->select('id')->from('evidenta_lucrari')->where('nr_intern', $nr_intern)->get()->row(0)->id;


        $this->add_status_citire_implicati($_POST['lucratori_implicati'], $id);


        return $id;
    }

    function adauga_versiune($id) {
//   function adauga_versiune()
        $data_time_request = date('Y-m-d H:i:s', time());

        //TODO: nr_intern ? id (mai degraba!) sa 'vina' ca parametru

        $nr_intern = $_POST['nr_intern'];
//        $nr_dgcti = $_POST['nr_dgcti'];
        //TODO: ?? e nr_intern + data , nu??

        $query = $this->db->query('SELECT max(versiune) as maxid FROM versiuni where nr_intern = "' . $nr_intern . '"');
        $row = $query->row();
        $max_id = $row->maxid;
        $vers = $max_id + 1;

        $vers_data = array(
            'rezolvare' => $_POST['detaliere'],
            'nr_intern' => $_POST['nr_intern'] . "", //!!!data
            'id_stadiu' => $_POST['id_stadiu'],
            'versiune' => $vers,
            'data_operare' => $data_time_request
        );

        $this->db->insert('versiuni', $vers_data);
    }

    function adauga_optic() {
        $vers_data = array(
            'id_grad_clasif' => $_POST['id_grad_clasif'],
            'nr' => $_POST['nr'],
            'data' => $_POST['data'],
            'id_lucrare' => $_POST['id_lucrare'],
            'descriere' => $_POST['detaliere']
        );
        $this->db->insert('suporti_optici', $vers_data);
    }

    function adauga_fisier() {
        $file_data = array(
            'name' => $_POST['name'],
            'id_vers' => $_POST['id_vers']
        );
        $this->db->insert('files', $file_data);
    }

}

?>
