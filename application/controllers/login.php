<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function index()
    {
        if (isset($_POST['log']))
        {
            if ($_POST['User'] == null || $_POST['Password'] == null)
            {
                $data['msg3'] = '<p style="color:red;">Completati datele de conectare</p>';
                $this->load->view('login_view', $data);
            }
            else
            {
                $username_post = $_POST['User'];
                $parola = md5($_POST['Password']);

//                $data['utilizatori'] = $this->db->select('*')->from('utilizatori')->where(array('username' => $username_post, 'parola' => $parola))->get()->row(0);
                $data['utilizatori'] = $this->db->select('*')->from('utilizatori')->where(array('username' => $username_post, 'parola' => $parola))->get();

//                $this->db->where('rol', '1');//////

//                $this->db->where('username', $username_post);
//                $this->db->where('parola', $parola);
//                $data['utilizatori'] = $this->db->get('utilizatori');

//                $u_email_obj->email

//                var_dump($data['utilizatori']->result());exit;
//                var_dump($data['utilizatori']->num_rows());exit;

                if ($data['utilizatori']->num_rows() == 1)
                {
                    $data['utilizatori'] = $data['utilizatori']->result();

                    $_SESSION['user'] = $username_post;
//                    $_SESSION['user_role'] = $data['utilizatori']->rol;
                    $_SESSION['user_role'] = $data['utilizatori'][0]->rol;
                    $_SESSION['user_id'] = $data['utilizatori'][0]->id;


                    if ($_SESSION['user_role'] == '0')
                    {
                        //ADD Retete
//                            redirect('lucrari/cauta_lucrari');
//                        redirect('lucrari/add_lucrari');
                        redirect('lucrari/salveazaReteta');
                    } elseif ($_SESSION['user_role'] == '1')
                    {
                        //cauta Doctori / Retete
                        redirect('lucrari/cauta_lucrari');
//??
//                            redirect('lucrari/lucrari_personale');
                    } elseif ($_SESSION['user_role'] == '2')
                    {
                        //Cont INACTIV!!!
//                            redirect('lucrari/lucrari_personale');
                        $data['msg3'] = '<p style="color:red;">CONT INACTIV!!!</p>';
                        $this->load->view('login_view', $data);
                    }
                }
                elseif ($data['utilizatori']->num_rows() <= 0)
                {
                    $data['msg3'] = '<p style="color:red;">Date de conectare incorecte</p>';
                    $this->load->view('login_view', $data);
                }
                
            }
        }else
            $this->load->view('login_view');
    }

}

?>