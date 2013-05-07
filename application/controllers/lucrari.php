<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lucrari extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['user_id']))
            redirect(base_url() . 'login');
        $this->load->helper(array('form', 'url'));

        $this->load->model('retetemodel');

    }

    function get_lucrare_detail_by_nr() {
        $nr_intern = $this->uri->segment('3');
        $data_nr_intern = $this->uri->segment('4');
        $this->load->model('lucrarimodel');
        $this->lucrarimodel->get_lucrare_detail_by_nr($nr_intern, $data_nr_intern);
    }

    function lucrari_serviciu() {
        $cod = 'jkasfn32678anmd';

        $this->load->model('mautorizare');
        $this->mautorizare->autorizeaza($cod);

        $nerepartizate = $repartizate = $id_lucrator = null;

        //TODO: sa vina bine din JS: repartizat la : fara Nerepartizate !!
        if (isset($_POST['nerepartizate_cbx'])) {
            $nerepartizate = 1;
        }
//        else
//        {
        if (isset($_POST['repartizate_cbx'])) {
            $repartizate = 1;
        }
        if (isset($_POST['id_lucrator_repartizat']) && ($_POST['id_lucrator_repartizat'] != 99999)) {
            $id_lucrator = $_POST['id_lucrator_repartizat'];
        }
//        }

        $this->load->model('lucrarimodel');

        $data['lucratori'] = $this->db->get('lucratori');
        $data['evidenta_lucrari'] = $this->lucrarimodel->lucrari_serviciu($nerepartizate, $repartizate, $id_lucrator);

        $this->load->view('lucrari_view', $data);
    }

    function select_lucrare_connect() {
        $id_vers = $this->uri->segment('3');
        $nr_intern = $this->uri->segment('4') . '/' . $this->uri->segment('5');
        $id_lucrare = $this->uri->segment('6');
        $_SESSION['id_vers_baza'] = $id_vers;
        $_SESSION['lucrare_baza'] = $nr_intern;
        $_SESSION['id_lucrare_baza'] = $id_lucrare;
        redirect(base_url() . 'lucrari/detaliere_lucrare/' . $id_lucrare);
    }

    function connect_lucrare()
    {
        $id_lucrare_curenta = $this->uri->segment('5');

        $nr_intern_lucrare_principala = $_SESSION['lucrare_baza'];
        $nr_intern_lucrare_secundara = $this->uri->segment('3') . '/' . $this->uri->segment('4');
        $vers_lucrare_principala = $_SESSION['id_vers_baza'];

        $this->db->select('id')->from('lucrari_relationate');
        $this->db->where('nr_intern_lucrare_principala', $nr_intern_lucrare_principala);
        $this->db->where('vers_lucrare_principala', $vers_lucrare_principala);
        $this->db->where('nr_intern_lucrare_secundara', $nr_intern_lucrare_secundara);
        $result = $this->db->get()->row(0);

        if (empty($result))
        {
            $data_time_request = date('Y-m-d H:i:s', time());

            $data_insert = array(
                'nr_intern_lucrare_principala' => $nr_intern_lucrare_principala,
                'vers_lucrare_principala' => $vers_lucrare_principala,
                'nr_intern_lucrare_secundara' => $nr_intern_lucrare_secundara,
                'id_operator' => $_SESSION['user_id'],
                'status' => '1',
                'time' => $data_time_request
            );

            $this->db->insert('lucrari_relationate', $data_insert);

            $this->remove_selected();

            redirect(base_url() . 'lucrari/');
        }
        else
        {
//            print_r($_COOKIE);

//            $_COOKIE['conexare_exitenta'] = 1;
//            setcookie('conexare_exitenta', 1);

//            print_r($_COOKIE);


//            redirect(base_url() . 'lucrari/detaliere_lucrare/' . $id_lucrare_curenta);
            redirect(base_url() . 'lucrari/detaliere_lucrare/' . $id_lucrare_curenta . "/cnx");
        }
    }

    function remove_selected() {
        $id_lucrare = $_SESSION['id_lucrare_baza'];
        $_SESSION['lucrare_baza'] = null;
        $_SESSION['id_lucrare_baza'] = null;
        redirect(base_url() . 'lucrari/detaliere_lucrare/' . $id_lucrare);
    }

    function lucrari_personale() {
        $cod = 'drfasgdfas12343243221';

        $this->load->model('mautorizare');
        $this->mautorizare->autorizeaza($cod);

        $this->load->model('lucrarimodel');

        $data['evidenta_lucrari'] = $this->lucrarimodel->lucrari_personale();

        $this->load->view('lucrari_view', $data);
    }

    function lucrari_personale_by_status() {
        /* $cod = 'drfasgdfas123432asda1';
          $this->load->model('mautorizare');
          $this->mautorizare->autorizeaza($cod); */
        $this->load->model('lucrarimodel');
        $data['evidenta_lucrari'] = $this->lucrarimodel->lucrari_personale();
        $this->load->view('lucrari_view', $data);
    }

    function cauta_lucrari() {
        /*$cod = 'sadnfyuy23';

        $this->load->model('mautorizare');
        $this->mautorizare->autorizeaza($cod);*/

        if ($_POST) {
            $this->load->model('lucrarimodel');

//            $data['evidenta_lucrari'] = $this->lucrarimodel->lucrari_serviciu($nerepartizate, $repartizate, $id_lucrator);

            $data['lucratori'] = $this->db->get('lucratori');
            $data['evidenta_lucrari'] = $this->lucrarimodel->cauta_lucrare($_POST);

            $this->load->view('lucrari_view', $data);
        } else {
            $data['structuri_emitente'] = $this->db->order_by("name", "asc")->get('structuri_emitente')->result();

            $this->load->view('cauta_lucrari_view', $data);
        }
    }

    function detaliere_lucrare($id_lucrare, $citire = null)
    {
        $cod = 'jkasdna89765';

        $this->load->model('mautorizare');
        $this->mautorizare->autorizeaza($cod);

        //??
//        $id = $this->uri->segment('3');

        $this->load->model('lucrarimodel');
        $this->load->model('usermodel');

        $data['lucratori'] = $this->db->get('lucratori');
        //??
        $data['detaliere_lucrare'] = $this->lucrarimodel->detaliere_lucrare($id_lucrare, $citire);

        $this->load->model('commentsmodel');
        $data['comments_lucrare'] = $this->commentsmodel->getCommentsLucrare($id_lucrare);

        $this->load->view('detaliere_lucrare_view', $data);
    }

    function repartizare_lucrare($id_lucrare) {
        $cod = 'asfsagfsagagsa1231';

        $this->load->model('mautorizare');
        $this->mautorizare->autorizeaza($cod);

        $this->load->model('lucrarimodel');
        $this->load->model('usermodel');

        //TODO: in caz ca e vreun camp completat: sa il incarce ca pt Update

        if ((isset($_POST['id_lucrator_repartizat']) && ($_POST['id_lucrator_repartizat'] != 99999)) && (isset($_POST['comentariu']))) {
            $_POST['lucratori_implicati'] = $_POST['id_lucrator_repartizat'];

            $lucratori = $this->db->get('lucratori');
            $result_lucratori = $lucratori->result();

            foreach ($result_lucratori as $lucratori) {
                $id_lucrator = $lucratori->id;

                if (isset($_POST['id_lucrator_' . $id_lucrator]) && $_POST['id_lucrator_' . $id_lucrator] != null) {
                    $_POST['lucratori_implicati'] .= '-' . $_POST['id_lucrator_' . $id_lucrator];
                }
            }

            if (!isset($_POST['termen'])) {
                $_POST['termen'] = "";
            }


            //update_lucrare + add_vers
            $this->lucrarimodel->repartizeaza_lucrare($id_lucrare);

//            $this->vers_add($id);

            redirect("notifications/notify_added/$id_lucrare");
        }
        /* else
          {
          } */
    }

    function checkIfExists()
    {
        $nr_intern = $_POST['nr_intern'];

        $this->load->model('lucrarimodel');
        $_exists = $this->lucrarimodel->_ifExists($nr_intern);

        echo json_encode(array('result' => $_exists));
    }

    public function getMedicamenteNomenclator($id_camp_medicament)
    {
//        $this->load->model("");

        $nume_camp_medicament = "medicament_$id_camp_medicament";

        $valoare_camp_medicament = $_GET[$nume_camp_medicament];

        if (isset($valoare_camp_medicament))
        {
            $q = strtolower($valoare_camp_medicament);
//            $this->retetemodel->;
        }
    }


    /*function get_birds()
    {
        $this->load->model('birds_model');
        if (isset($_GET['term']))
        {
            $q = strtolower($_GET['term']);
            $this->birds_model->get_bird($q);
        }
    }*/
    public function getMedicamenteNecompensate()
    {
        //TODO?? din js - dinamic, apelez functia de autocomplete pt fiecare input creat
        //  acolo pun in parametru si id-u'

        //??switch ce medicamente sa returneze: compens?necompens

        //$input = $_GET['medicament_1'];
		$input = $_GET['term'];
		
		//source: "lucrari/getMedicamenteNecompensate"
		
		//var_dump($_GET);
		//var_dump($_POST);
		
 		//exit;
		
        echo "CEVA!!1!!";

//        var_dump($input);exit;

        if (isset($input))
        {
            $input = strtolower($input);
            $this->retetemodel->getMedicamente($input);
        }
/*        if (isset($_GET['term']))
        {
            $q = strtolower($_GET['term']);
            $this->retetemodel->getMedicamente($q);
        }*/
    }


//    function adauga_reteta()
//    function inregistreazaReteta()
    public function salveazaReteta()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        /*$this->form_validation->set_message('exact_length', 'Campul %s nu are lungimea necesara!');
        $this->form_validation->set_message('numeric', 'Campul %s trebuie sa aiba doar cifre!');
        $this->form_validation->set_message('alpha', 'Campul %s trebuie sa aiba doar litere!');
        $this->form_validation->set_message('required', 'Campul %s este obligatoriu!');*/


//        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('tip_reteta', 'Tip Rețetă', 'required');
        $this->form_validation->set_rules('farmacie', 'Farmacie', 'required');
        //??? verificare conditionata!!
        $this->form_validation->set_rules('serie_reteta_compensata', 'Serie Rețetă Compensată', 'required');
        $this->form_validation->set_rules('nr_reteta_compensata', 'Nr. Rețetă Compensată', 'required');

        $this->form_validation->set_rules('data_eliberare_reteta', 'Data Eliberare Rețetă', 'required|exact_length[10]');
        $this->form_validation->set_rules('nr_fisa_pacient', 'Nr. Fișă Pacient', 'required');
        $this->form_validation->set_rules('nr_registru_consultatii', 'Nr. Registru Consultații', 'required');
        $this->form_validation->set_rules('nr_dosar', 'Nume Dosar', 'required');
        $this->form_validation->set_rules('nr_reteta_dosar', 'Nr. Rețetă din Dosar', 'required|numeric');
        $this->form_validation->set_rules('nume_doctor', 'Nume Doctor', 'required');
        $this->form_validation->set_rules('cod_parafa_doctor', 'Cod Parafă Doctor', 'required|numeric');
        $this->form_validation->set_rules('cnp_pacient', 'CNP', 'required|exact_length[13]|numeric');
        $this->form_validation->set_rules('nume_pacient', 'Nume', 'required|alpha');//??
        $this->form_validation->set_rules('prenume_pacient', 'Prenume', 'required|alpha');//???
        $this->form_validation->set_rules('medicament_1', 'Medicament 1', 'required');



        /*$config = array(
            array( ..

        $this->form_validation->set_rules($config);
        */

        $data = array();
        $data['doctori'] = $this->db->get('doctori')->result();
        $data['farmacii'] = $this->db->get('farmacii')->result();

        if ($_POST)
        {
            //A completat, da Inregistrare -> validare -> INSERT DB

//            if ($this->form_validation->run() == FALSE)
            if ($this->form_validation->run())
            {
                //success
                //INSERT

                echo "success";
//                $this->load->view('formsuccess');

//                $this->load->model('retetemodel');//??????constructor!!


                //if.... insert    else    update


//                $id_comentariu = $this->retetemodel->adaugaReteta($id_lucrare);//pt celelalte tabele
//                $id_reteta = $this->retetemodel->adaugaReteta();
                $id_reteta = $this->retetemodel->inregistreazaReteta();

            }
            else
            {
                //error

//                echo "error";
//                $this->load->view('myform');
                $this->load->view('salveaza_reteta', $data);
            }
        }
        else
        {
            //VIEW pt COMPLETAT

            $this->load->view('salveaza_reteta', $data);
        }
    }
    function add_lucrari() {
//    function adauga_reteta() {
        /*$cod = 'ikansdfj334';

        $this->load->model('mautorizare');
        $this->mautorizare->autorizeaza($cod);*/
        $data = array();
        if ($_POST)
        {
            $servicii = $this->db->get('servicii');
            $nr_servicii = $servicii->num_rows();

            $_POST['servicii_implicate'] = $_POST['id_serv_titular'];

            for ($i = 1; $i <= $nr_servicii; $i++)
            {
                if (isset($_POST['id_serviciu_' . $i]) && $_POST['id_serviciu_' . $i] != null)
                {
                    $_POST['servicii_implicate'] .= '-' . $_POST['id_serviciu_' . $i];
                }

                /*if (isset($_POST['id_serviciu_' . $i]) && $_POST['id_serviciu_' . $i] != null) {
                    $_POST['servicii_implicate'] = $_POST['servicii_implicate'] . '-' . $_POST['id_serviciu_' . $i];
                } else {
                    $_POST['servicii_implicate'] = $_POST['id_serv_titular'];
                }*/
            }

            $lucratori = $this->db->get('lucratori');
            $result_lucratori = $lucratori->result();


            //TODO ??? CAND se ADD Lucrare Proprie... de catre Lucrator!!  EX. MALINA..discutie
            //TODO: lucrator normal, nu ar trebui sa ADD lucrare, nu??? (sau daca da, o repartizeaza cuiva???  // ca vad ca implicit e sa nu fie repartizat!!)
            //=> spre rez /?? spre promovare?
            /*if (!isset($_POST['id_lucrator_repartizat'])) {
                $_POST['id_lucrator_repartizat'] = 99999;
                $_POST['lucratori_implicati'] = "";


                //TODO ? analog pt rez intern si data rez??    : pun null sau "" ?

                $_POST['rezolutionar_intern'] = "";
                $_POST['data_rezolutie'] = "";
                $_POST['termen'] = "";

                $_POST['id_stadiu'] = 99999;
            } else {
                $_POST['lucratori_implicati'] = $_POST['id_lucrator_repartizat'];

                foreach ($result_lucratori as $lucratori) {
                    $id_lucrator = $lucratori->id;
                    if (isset($_POST['id_lucrator_' . $id_lucrator]) && $_POST['id_lucrator_' . $id_lucrator] != null) {
                        $_POST['lucratori_implicati'] .= '-' . $_POST['id_lucrator_' . $id_lucrator];
                    }
                }
            }*/
            if (isset($_POST['id_lucrator_repartizat']))
            {
                //TODO optimize: same piece of code!
                $_POST['lucratori_implicati'] = $_POST['id_lucrator_repartizat'];

                foreach ($result_lucratori as $lucratori) {
                    $id_lucrator = $lucratori->id;
                    if (isset($_POST['id_lucrator_' . $id_lucrator]) && $_POST['id_lucrator_' . $id_lucrator] != null) {
                        $_POST['lucratori_implicati'] .= '-' . $_POST['id_lucrator_' . $id_lucrator];
                    }
                }
            }
            else
            {
                //cazul: !isset($_POST['id_lucrator_repartizat'])
                if ($_SESSION['user_role'] != '1')
                {
                    //daca nu e secretariat, ci lucrator simplu

                    $_POST['id_lucrator_repartizat'] = $_SESSION['id_lucrator'];

                    //TODO optimize: same piece of code!
                    $_POST['lucratori_implicati'] = $_POST['id_lucrator_repartizat'];

                    foreach ($result_lucratori as $lucratori) {
                        $id_lucrator = $lucratori->id;
                        if (isset($_POST['id_lucrator_' . $id_lucrator]) && $_POST['id_lucrator_' . $id_lucrator] != null) {
                            $_POST['lucratori_implicati'] .= '-' . $_POST['id_lucrator_' . $id_lucrator];
                        }
                    }

                }
            }

            if ($_POST['id_structura_emitenta'] == '99999') {
                $data = array(
                    'name' => $_POST['structura_emitenta']
                );
                $this->db->insert('structuri_emitente', $data);
                $this->db->where('name', $_POST['structura_emitenta']);
                $structura_emitenta = $this->db->get('structuri_emitente');
                foreach ($structura_emitenta->result() as $rows) {
                    $id = $rows->id;
                }
                $_POST['id_structura_emitenta'] = $id;
            } else {
                $_POST['id_structura_emitenta'] = $_POST['id_structura_emitenta'];
            }
            $this->load->model('lucrarimodel');
            $id_lucrare = $this->lucrarimodel->adauga_lucrare($_POST);


            //stabilire ordine:    notify | view_details
            //notify by mail!!
            redirect("notifications/notify_added/$id_lucrare");
        } else {
            $data['grade_clasificare'] = $this->db->get('grade_clasif');
            $data['tipuri_exemplar'] = $this->db->get('tipuri_exemplar');
            $data['structuri_emitente'] = $this->db->order_by("name", "asc")->get('structuri_emitente')->result();
            $data['indici_arh'] = $this->db->get('indici_arh');
            $data['servicii'] = $this->db->get('servicii');
            $this->db->order_by("name", "asc");
            $data['lucratori'] = $this->db->get('lucratori');
            $data['stadii'] = $this->db->get('stadii');
            $data['lucrari'] = $this->db->get('evidenta_lucrari');

            $this->load->view('add_lucrari_view', $data);
//            $this->load->view('adauga_reteta', $data);
        }
    }

    function add_comment($id_lucrare)
    {
        $this->load->model('commentsmodel');
        $id_comentariu = $this->commentsmodel->addComment($id_lucrare);

        //notify ->email
        redirect("notifications/notify_comment/$id_comentariu");


        redirect("lucrari/detaliere_lucrare/$id_lucrare");
    }

//    function vers_add($, $id)
    function vers_add() {
        //se adauga vers si prima data la add lucrari, nu?

        /* ?? TODO: de facut aici 2 parti:    ? (momentan incorporat in repartizare-ca la add)
          1. add din add_lucr,  (ia din post)
          2. add din repartizare (ia din db, id-> nr_intern.. )
         */

        //initial:
        $cod = 'adnfjai23432asdf';

        $this->load->model('mautorizare');
        $this->mautorizare->autorizeaza($cod);

        $id_lucrare = $this->uri->segment('5');

        if ($_POST) {
            //apare detaliere view cu noile detalii

            $this->load->model('lucrarimodel');
            $this->lucrarimodel->adauga_versiune($_POST);

            redirect("lucrari/detaliere_lucrare/$id_lucrare");
        } else {
            //apare view cu introducere detalii versiune

            $data['nr_intern'] = $this->uri->segment('3') . '/' . $this->uri->segment('4');
            $data['stadii'] = $this->db->get('stadii');
            $data['id_lucrare'] = $id_lucrare;

            $this->load->view('add_vers_view', $data);
        }
    }

    function optic_add() {
        $cod = 'ghsdvfi2342njsd';

        $this->load->model('mautorizare');
        $this->mautorizare->autorizeaza($cod);

        $id_lucrare = $this->uri->segment('3');

        if ($_POST) {
            $this->load->model('lucrarimodel');
            $this->lucrarimodel->adauga_optic($_POST);

            redirect("lucrari/detaliere_lucrare/$id_lucrare");
        } else {
            $data['grade_clasificare'] = $this->db->get('grade_clasif');
            $data['id_lucrare'] = $id_lucrare;
            $data['stadii'] = $this->db->get('stadii');

            $this->load->view('add_optic_view', $data);
        }
    }

    function file_add() {
        $cod = 'dfngjnui783453';

        $this->load->model('mautorizare');
        $this->mautorizare->autorizeaza($cod);

        $id_vers = $this->uri->segment('3');
        $id_lucrare = $this->uri->segment('4');

        if ($_POST) {
            $target_path = "files/";
            $target_path = $target_path . basename($_FILES['fileToBeSigned']['name']);
            $_POST['name'] = basename($_FILES['fileToBeSigned']['name']);

            if (move_uploaded_file($_FILES['fileToBeSigned']['tmp_name'], $target_path)) {
                $this->load->model('lucrarimodel');
                $this->lucrarimodel->adauga_fisier($_POST);

                redirect("lucrari/detaliere_lucrare/$id_lucrare");
            } else {
                echo "There was an error uploading the file, please try again!";
            }
        } else {
            $data['id_vers'] = $id_vers;
            $data['id_lucrare'] = $id_lucrare;
            $this->load->view('add_file_view', $data);
        }
    }

}