<?php

class Usermodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function person_details() {
        $this->db->where('lucratori.id', $_SESSION['id_lucrator']);
        $this->db->select('*,servicii.name as nume_serviciu,servicii.descriere as descriere_serviciu, lucratori.name as nume');
        $this->db->from('lucratori');
        $this->db->join('lucratori_detail', 'lucratori.id=lucratori_detail.id_lucrator', 'left');
        $this->db->join('servicii', 'lucratori.id_serv=servicii.id', 'left');
        $query = $this->db->get();
        return $query;
    }

    function edit_account() {
        $this->db->where('lucratori.id', $_SESSION['id_lucrator']);
        $this->db->select('*,servicii.name as nume_serviciu,servicii.descriere as descriere_serviciu, lucratori.name as nume');
        $this->db->from('lucratori');
        $this->db->join('lucratori_detail', 'lucratori.id=lucratori_detail.id_lucrator', 'left');
        $this->db->join('servicii', 'lucratori.id_serv=servicii.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

//    function update_account($_POST) {
    function update_account() {
        $this->db->where('id_lucrator', $_SESSION['id_lucrator']);
        $check = $this->db->get('lucratori_detail');
        if ($check->num_rows() > 0) {
            $data = array(
                'mail' => $_POST['mail'],
                'telefon' => $_POST['telefon'],
                'despre' => $_POST['despre']
            );
            $this->db->where('id_lucrator', $_SESSION['id_lucrator']);
            $this->db->update('lucratori_detail', $data);
            $data1 = array(
                'name' => $_POST['nume']
            );
            $this->db->where('id', $_SESSION['id_lucrator']);
            $this->db->update('lucratori', $data1);
        } else {
            $data = array(
                'mail' => $_POST['mail'],
                'telefon' => $_POST['telefon'],
                'despre' => $_POST['despre'],
                'id_lucrator' => $_SESSION['id_lucrator']
            );
            $this->db->insert('lucratori_detail', $data);
        }
        redirect('welcome/my_account');
    }
    function add_picture()
    {
        $id_lucrator = $_SESSION['id_lucrator'];

        $email = $this->getEMails($id_lucrator);
        $email = $email[0];

//        $despre = ;
//        $tel = ;

        $data1 = array(
            'poza' => $_POST['name'],
            'mail' => $email,
            'id_lucrator' => $id_lucrator
//            'despre' => $despre,
//            'telefon' => $tel
        );
//        $this->db->where('id_lucrator', $id_lucrator);
//        $this->db->update('lucratori_detail', $data1);
        $this->db->insert('lucratori_detail', $data1);
    }

    //TODO : generalizare   ...array_ids=string, nu?
    function getNames($id_oneORmore, $db_tbl)
    {
        //db = lucratori | servicii

        $arrayNames = $array_ids = array();

        if (strpos($id_oneORmore, '-') === false)
        {
            //e doar titularul
            $array_ids = "$id_oneORmore";
        }
        else
        {
            //sa fortez aici sa intre doar cel putin un colaborator: gen:  x-x

            //primul o sa fie titularul
            $array_ids = array_filter(explode('-', $id_oneORmore, 2));

            //?? daca e doar titular- => [1] = ??
            $array_ids = join(',', array_filter(explode('-', $array_ids[1])));
        }
        $arrayNames = $this->db->select('name')->from("$db_tbl")->where("id in ($array_ids)")->get()->result();

        return $arrayNames;
    }

    //de verificat unde e apelat asta:?? null
    function getEMails($id_oneORmore, $type_implicati = null, $id_user_logat = null)
    {
        $arrayEMails = $array_ids = array();

        //tratare daca vine array doar cu un elem??
        if (strpos($id_oneORmore, '-') === false)
        {
            //sg id
            $array_ids = "$id_oneORmore";
        }
        else
        {
            if (is_null($type_implicati))
            {
                //aici n-ar trebui sa-l mai omit pe primu', corect ?

                if (count(array_filter(explode('-', $id_oneORmore))) == 1)
                {
                    $x = explode('-', $id_oneORmore);
                    $array_ids = $x[0];
                }
                elseif (count(array_filter(explode('-', $id_oneORmore))) >= 2)
                {
                    $array_ids = join(',', array_filter(explode('-', $id_oneORmore)));
                }
            }
            else
            {
                //obtin pt cei implicati, deci omit pe primul!

                $array_ids = array_filter(explode('-', $id_oneORmore, 2));

                $array_ids = join(',', array_filter(explode('-', $array_ids[1])));
            }
        }

        //TODO: ? join?

        $array_user_ids = $this->db->select('user_id')->from('lucratori')->where("id in ($array_ids)")->get()->result();

        /*foreach ($array_user_ids as $u_id_obj)
        {
            $u_email_obj = $this->db->select('email')->from('users')->where('id', $u_id_obj->user_id)->get()->row(0);

            array_push($arrayEMails, $u_email_obj->email);
        }*/


        if (!isset($id_user_logat)) //?? //is_null
        {
            echo "_!_ISSET_";exit;

            foreach ($array_user_ids as $u_id_obj)
            {
                $u_email_obj = $this->db->select('email')->from('users')->where('id', $u_id_obj->user_id)->get()->row(0);

                array_push($arrayEMails, $u_email_obj->email);
            }
        }
        else
        {
            echo "_ISSET_ $id_user_logat _ "; print_r($array_user_ids);//exit;

            foreach ($array_user_ids as $u_id_obj)
            {
                //parametru conditional pt comentariu NU la titular!

                //pt cel logat = care a dat comentariu, sa nu-i trimita mail
                if ($id_user_logat != $u_id_obj)
                {
                    echo "_ISSET_ $u_id_obj _ ";

                    $u_email_obj = $this->db->select('email')->from('users')->where('id', $u_id_obj->user_id)->get()->row(0);

                    array_push($arrayEMails, $u_email_obj->email);
                }
            }
            exit;
        }
        return $arrayEMails;
    }

    //TODO: - verificare functii getNames / getEMails
}

?>
