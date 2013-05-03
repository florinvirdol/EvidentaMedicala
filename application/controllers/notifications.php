<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifications extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        if(!isset($_SESSION))
        {
            session_start();
        }

        $this->load->model('usermodel');
        $this->load->model('commentsmodel');
    }

    //TODO!!! pt SEFI: ?? comportament analog "spre promovare"   ~= "spre repartizare" !??
    //TODO? add_lucrare din partea unui lucrator?? cum e cu repartizarea?

    public function notify_suggestion() {
        if ($_POST) {
            //autor = nu ar trebui numele celui logat?

//            if ($_POST['autor'] == null || $_POST['sugestie'] == null) {
            if ($_POST['sugestie'] == null) {
//                $data['eroare'] = '<p style="color:red;">Completati ambele campuri!</p>';
                $data['eroare'] = '<p style="color:red;">Completati campul!</p>';
                //??validare jquery? _not-reLoaded!
                $this->load->view('sugestii_view', $data);
            } else {
                $sugestie = $_POST['sugestie'];

//                $autor = $_POST['autor'];

//                var_dump($_SESSION['id_lucrator']);exit;
//                var_dump($_SESSION);exit;

                $autor = $this->usermodel->getNames($_SESSION['id_lucrator'], "lucratori");
                $autor = $autor[0]->name;

                $data_time_request = date('Y-m-d H:i:s', time());

                $db = array(
                    'sugestie' => $sugestie,
                    //??cel care opereaza..
                    'autor' => $autor,
                    'time' => $data_time_request
                );

                $this->db->insert('sugestii', $db);

                ///send mail de confirmare
                $to_array = array("george.mihalache@mai.intranet", "florin.virdol@mai.intranet");
//                $to_array = array("florin.virdol@mai.intranet");
//                $to_array = array("florin.virdol@mai.gov.ro");
                $subject = "Sugestie aplicatie";
                $message = "Utilizatorul $autor a scris urmatoarea sugestie: <br> $sugestie";

                $this->send_mail($to_array, null, null, $subject, $message);

                redirect(base_url());
            }
        } else {
            $this->load->view('sugestii_view');
        }
    }

    public function notify_comment($id_comentariu)
    {
        //????TODO:: trimite mail si celui care scrie comment!! cami

        $this->load->model('lucrarimodel');

        //model: select db details => object Comment
        $comment_obj = $this->commentsmodel->getCommentDetails($id_comentariu);

//TODO verify if obj = null.. ?? oricum nu cred ca ajunge null

        $id_lucrare = $comment_obj->id_lucrare;
        $id_sender = $comment_obj->id_sender;
        $ids_implicati = $comment_obj->ids_implicati;
        $date = $comment_obj->time;

        $nr_intern = $this->lucrarimodel->getLucrareNrIntern($id_lucrare);
        $nr_intern = isset($nr_intern) ? $nr_intern : "Neasignat";

        $sender_name =$this->usermodel->getNames($id_sender, "lucratori");
        $sender_name = $sender_name[0]->name;


        $_html_start = "<html><head></head><body>";
        $_html_end = "</html></body>";

        $link = base_url() . "lucrari/detaliere_lucrare/$id_lucrare/c";
        $link_accesare = "<br><br>Lucrarea poate fi accesata <b><a href=\"$link\">aici.</a></b>  $_html_end";

//        var_dump($_SESSION);exit;
        $id_user_logat = $_SESSION['user_id'];

        //teoretic, n-ar trebui notificat si cel care posteaza comentariul!!
        $to_array = $this->usermodel->getEMails($ids_implicati, null, $id_user_logat);

        $subject = "Comentariu nou la Lucrarea (Nr. Intern: $nr_intern)";

        $message = "$_html_start A fost postat un nou comentariu de catre $sender_name in data: $date.";
        $message .= " $link_accesare";

        $this->send_mail($to_array, null, null, $subject, $message);

        //??
        redirect("lucrari/detaliere_lucrare/$id_lucrare");
    }


    //?nu ar trebui sa fie optioanl, nu? verificare!
//    public function notify_added($id_lucrare = null)
    public function notify_added($id_lucrare)
    {
        //?? pus in constructor
//        $this->load->model('usermodel');

        $lucrare_obj = $this->db->select('nr_intern, detaliere_lucrare, id_lucrator_repartizat, lucratori_implicati, rezolutionar_intern, data_sistem, id_user_operator')->from('evidenta_lucrari')->where('id', $id_lucrare)->get()->row(0);

        $nr_intern = $lucrare_obj->nr_intern;
        $detaliere_lucrare = $lucrare_obj->detaliere_lucrare;
        $detaliere_lucrare = "<em>\"$detaliere_lucrare\"</em>";
        $id_lucrator_repartizat = $lucrare_obj->id_lucrator_repartizat;
        $lucratori_implicati = $lucrare_obj->lucratori_implicati;

        //la sefi!?
        $rezolutionar_intern = $lucrare_obj->rezolutionar_intern;

        $data_sistem = $lucrare_obj->data_sistem;
        $data_sistem = "<em>$data_sistem</em>";

        //nu cred ca trebuie, posibil sa fie (el), sefii sau secretariatu'?
        $id_user_operator = $lucrare_obj->id_user_operator;


        $_html_start = "<html><head></head><body>";
        $_html_end = "</html></body>";

        $msg_subject = " - Lucrare noua (Nr. Intern: ";
        $msg_detaliere = " cu urmatoarea detaliere: <br>";

        $link = base_url() . "lucrari/detaliere_lucrare/$id_lucrare/c";
        $link_accesare = "<br><br>Lucrarea poate fi accesata <b><a href=\"$link\">aici.</a></b>  $_html_end";

        if ($id_lucrator_repartizat != 99999) {
            $to_array_t = $this->usermodel->getEMails($id_lucrator_repartizat, null);

            $subject_t = "Titular $msg_subject $nr_intern)";

            $message_t = "$_html_start Aveti o noua lucrare din $data_sistem ";

            //daca are '-'
//            if (strpos($lucratori_implicati, '-') !== false)
            if (count(array_filter(explode('-', $lucratori_implicati))) >= 2) {
                //daca sigur e macar un colaborator
                //TODO: datatables: colaboratori..    verificare, count instead: strpos.!?

                $message_t .= "in colaborare cu: ";

//                $cc_array = $this->usermodel->getEMails($lucratori_implicati);

                $to_array_c = $this->usermodel->getEMails($lucratori_implicati, 1);

                $subject_c = "Colaborator $msg_subject $nr_intern)";

                $name_titular = $this->usermodel->getNames($id_lucrator_repartizat, "lucratori");
                $name_titular = $name_titular[0]->name;
                $name_titular = "<b>$name_titular</b>";

                $message_c = "$_html_start Sunteti implicat in noua lucrare a titularului $name_titular din $data_sistem in colaborare cu: ";

                //??mai pun toti colaboratorii, sau ajunge ca le dau la fiecare mail??
                $names_colaboratori = $this->usermodel->getNames($lucratori_implicati, "lucratori");
                foreach ($names_colaboratori as $n) {
                    $message_t .= "<b>$n->name</b>, ";
                    $message_c .= "<b>$n->name</b>, ";
                }

                $message_c .= " $msg_detaliere $detaliere_lucrare $link_accesare";

                $this->send_mail($to_array_c, null, null, $subject_c, $message_c);
            }
            $message_t .= "$msg_detaliere $detaliere_lucrare $link_accesare";

            $this->send_mail($to_array_t, null, null, $subject_t, $message_t);
        } else {
            //sefi - de rezolutionat
            //TODO: ? join?

            $stringIdsL = "";

            $array_users_ids = $this->db->select('id')->from('users')->where('role', 3)->get()->result();

            foreach ($array_users_ids as $u_id_obj) {
                $l_id_obj = $this->db->select('id')->from('lucratori')->where('user_id', $u_id_obj->id)->get()->row(0);
                $stringIdsL .= $l_id_obj->id . "-";
            }

            //trebe sa pun null??
//            $to_array_s = $this->usermodel->getEMails($stringIdsL);
            $to_array_s = $this->usermodel->getEMails($stringIdsL, null);


            //TODO: refactorizare!?!

            $subject_s = "De rezolutionat $msg_subject $nr_intern)";


            //TODO!! aici e spre rez!! => nu are titular nici colaboratori!!??

            $message_s = "Trebuie rezolutionata o noua lucrare din $data_sistem $msg_detaliere $detaliere_lucrare $link_accesare";

            $this->send_mail($to_array_s, null, null, $subject_s, $message_s);
        }

        //TODO?? sa-i punem si stadui, sau sa primeasca si mail cand ii se adauga o versiune???

        redirect("lucrari/detaliere_lucrare/$id_lucrare");
    }

    public function send_mail($to_array, $cc_array = null, $bcc_array = null, $subject, $message) {
        $this->load->library('email');


        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);


        $this->email->from('s6.dgcti@mai.intranet', 'Aplicatie - Evidenta Secretariat');
//        $this->email->from('s6.dgcti@mai.gov.ro', 'Aplicatie - Evidenta Secretariat');

        $this->email->to($to_array);
        $this->email->cc($cc_array);
        $this->email->bcc($bcc_array);

        $this->email->subject($subject);
        $this->email->message($message);

        //TODO: res = send ... if !rest => error_send
        $this->email->send();
        $this->add_log_mail($to_array, $subject, $message);
    }

    public function add_log_mail($to_array, $subject, $message) {
        $data_time_request = date('Y-m-d H:i:s', time());
        $mails = join(',',$to_array);
        $datab = array(
            'mail_destinatar' => $mails,
            'actiune' => $subject,
            'continut_mail' => $message,
            'time' => $data_time_request
        );
        $this->db->insert('log_alerte', $datab);
    }

}

?>