<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        if (!isset($_SESSION)) {
            session_start();
            if (!isset($_SESSION['user']))
                redirect(base_url() . 'login');
        }
    }

    public function index() {

        $this->load->view('welcome_view');
    }

    public function Error() {
        $data['eroare'] = 'Aceasta sectiune nu exista';
        $this->load->view('pages_view', $data);
    }

    public function neautorizat() {
        $data['msg3'] = 'Acces neautorizat!';
        $this->load->view('pages_view', $data);
    }

    function my_account() {
        if ($_POST) {
            
        } else {
            $this->load->model('usermodel');
            $data['person_details'] = $this->usermodel->person_details();
            $this->load->view('my_account_view', $data);
        }
    }

    function create_account() {
        $hash_mail = $this->uri->segment('3');
        $this->db->where('md5(email)', $hash_mail);
        $u = $this->db->get('users');
        if ($u->num_rows() > 0) {
            $data['hash_mail'] = $hash_mail;
            $data['servicii'] = $this->db->get('servicii');
            $this->load->view('create_account_view', $data);
        } else {
            redirect('welcome/neautorizat');
        }
    }

    function add_user() {
        if ($_POST['name'] == null || $_POST['new_pass'] == null || $_POST['new_pass2'] == null) {
            $data['msg3'] = '<p style="color:red;">Completati toate campurile!</p>';
            $data['hash_mail'] = $_POST['hash_mail'];
            $data['servicii'] = $this->db->get('servicii');
            $this->load->view('create_account_view', $data);
        } else {
            if ($_POST['new_pass'] != $_POST['new_pass2']) {
                $data['msg3'] = '<p style="color:red;">Câmpul "Parola" nu coincide cu câmpul "Confirmare parola"!</p>';
                $data['servicii'] = $this->db->get('servicii');
                $data['hash_mail'] = $_POST['hash_mail'];
                $this->load->view('create_account_view', $data);
            } else {
                $data = array(
                    'password' => md5($_POST['new_pass']),
                    'role' => '2'
                );
                $this->db->where('md5(email)', $_POST['hash_mail']);
                $this->db->update('users', $data);
                //
                $this->db->where('md5(email)', $_POST['hash_mail']);
                $users = $this->db->get('users');
                foreach ($users->result() as $r) {
                    $user_id = $r->id;
                    $email_address = $r->email;
                }
                //
                $d = array(
                    'name' => $_POST['name'],
                    'id_serv' => $_POST['id_serv'],
                    'user_id' => $user_id
                );
                $this->db->insert('lucratori', $d);
                ///send mail de confirmare
                $this->load->library('email');

                $this->email->from('george.mihalache@mai.intranet', 'Aplicatie secretariat');
                $this->email->to($email_address);

                $this->email->subject('Confirmare cont');
                $this->email->message('
                   Contul dumneavoastra a fost creat!
                   Pentru a accesa aplicatia clic aici
                        http://10.1.100.120/secretariat/
                ');

                $this->email->send();
                redirect('login');
            }
        }
    }

    function signup() {
        if ($_POST) {
            if ($_POST['email'] != null) {
                $hash = md5($_POST['email']);
                $this->load->library('email');

                $this->email->from('george.mihalache@mai.intranet', 'Aplicatie secretariat');
                $this->email->to($_POST['email']);
                //$this->email->cc('another@another-example.com');
                //$this->email->bcc('them@their-example.com');

                $this->email->subject('Completare informatii cont nou evidenta lucrari');
                $this->email->message('
                    Pentru a continua etapele de creere a contului in cadrul aplicatiei accesati urmatoarea adresa:
                    
                    
                        http://10.1.100.120/secretariat/welcome/create_account/' . $hash . '
                ');

                $this->email->send();
                redirect('login');
                //echo $this->email->print_debugger();
            } else {
                $data['msg3'] = 'Completați adresa de e-mail!';
                $this->load->view('new_account_view', $data);
            }
        } else {
            $this->load->view('new_account_view');
        }
    }

    function edit_account() {
        if ($_POST) {
            $this->load->model('usermodel');
            $data['person_details'] = $this->usermodel->update_account($_POST);
        } else {
            $this->load->model('usermodel');
            $data['person_details'] = $this->usermodel->edit_account();
            $this->load->view('edit_account_view', $data);
        }
    }

    function adauga_poza() {
        if ($_POST) {
            $target_path = "poza/";
            $target_path = $target_path . basename($_FILES['fileToBeSigned']['name']);
            $_POST['name'] = basename($_FILES['fileToBeSigned']['name']);
            if (move_uploaded_file($_FILES['fileToBeSigned']['tmp_name'], $target_path)) {
                $this->load->model('usermodel');
                $this->usermodel->add_picture($_POST);
                redirect('welcome/my_account');
            } else {
                echo "There was an error uploading the file, please try again!";
            }
        } else {
            $this->load->view('add_picture_view');
        }
    }

    function update_pass() {
        if ($_POST) {
            if ($_POST['old_pass'] == null || $_POST['new_pass'] == null || $_POST['new_pass2'] == null) {
                $data['msg3'] = '<p style="color:red;">Completati toate câmpurile</p>';
                $this->load->view('update_pass_view', $data);
            } elseif ($_POST['new_pass'] != $_POST['new_pass2']) {
                $data['msg3'] = '<p style="color:red;">Câmpul "Parola nouă" nu coincide cu câmpul "Confirmare parola nouă"!</p>';
                $this->load->view('update_pass_view', $data);
            } else {
                $this->db->where('password', $_POST['old_pass']);
                $useri = $this->db->get('users');
                if ($useri->num_rows() > 0) {
                    $data['msg3'] = '<p style="color:red;">Actuala parolă nu este corectă!</p>';
                    $this->load->view('update_pass_view', $data);
                } else {
                    $data = array(
                        'password' => md5($_POST['new_pass'])
                    );

                    $this->db->where('id', $_SESSION['user_id']);
                    $this->db->update('users', $data);
                    redirect('welcome/my_account');
                }
            }
        } else {
            $this->load->view('update_pass_view');
        }
    }

    function cauta_lucrari() {
        if ($_POST) {
            if ($_POST['tip_numar_cautare'] == '99999' && $_POST['id_structura_emitenta'] == '99999' && $_POST['detaliere_lucrare'] == null && $_POST['nr_cautare'] == null) {
                $data['structuri_emitente'] = $this->db->get('structuri_emitente');
                $data['eroare'] = '<p style="color:red;">Completaţi parametrii de căutare!</p>';
                $this->load->view('cauta_lucrari_view', $data);
            } else {
                if ($_POST['tip_numar_cautare'] == '99999') {
                    if ($_POST['id_structura_emitenta'] == '99999') {
                        $this->db->like('detaliere_lucrare', $_POST['detaliere_lucrare']);
                    } else {
                        $this->db->where('id_structura_emitenta', $_POST['id_structura_emitenta']);
                        $this->db->like('detaliere_lucrare', $_POST['detaliere_lucrare']);
                    }
                } else {
                    $this->db->like($_POST['tip_numar_cautare'], $_POST['nr_cautare']);
                }
                $this->db->order_by("vers", 'desc');
                $this->db->limit(1);
                $data['evidenta_lucrari'] = $this->db->get('evidenta_lucrari');
                $data['nr_rezultate'] = $data['evidenta_lucrari']->num_rows();
                $this->load->view('lucrari_view', $data);
            }
        } else {
            $data['structuri_emitente'] = $this->db->get('structuri_emitente');
            $this->load->view('cauta_lucrari_view', $data);
        }
    }

    function detaliere_lucrare() {
        $this->db->where('evidenta_lucrari.id', $this->uri->segment('3'));
        $this->db->select('* ,grade_clasif.name as grad_clasif,tipuri_exemplar.name as tip_exemplar, evidenta_lucrari.servicii_implicate as servicii_implicate,
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
        //$this->db->join('evidenta_lucrari', 'evidenta_lucrari.id = evidenta_lucrari.id_lucrari_conexate', 'left');
        $data['detaliere_lucrare'] = $this->db->get();
        $this->load->view('detaliere_lucrare_view', $data);
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */