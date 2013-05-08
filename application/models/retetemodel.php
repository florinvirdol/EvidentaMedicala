<?php

class Retetemodel extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        if(!isset($_SESSION))
        {
            session_start();
        }
    }

    public function getCommentsLucrare($id_lucrare)
    {
        $result = $this->db->select('*')->from('comments')->where('id_lucrare', $id_lucrare)->get()->result();

        return empty($result) ? 0 : $result;
    }

    //???
    public function getCommentDetails($id_comment)
    {
//        $this->db->select('*')->from('comments')->where('id', $id_comment)->limit(1)->get()->result;
        $comment_obj_result = $this->db->select('*')->from('comments')->where('id', $id_comment)->limit(1)->get()->row(0);

        return isset($comment_obj_result) ? $comment_obj_result : null;
    }

    public function adaugaMedicamentReteta($id_reteta)
    {
        $id_medicament = "";
        $pret = "";

        $data_medicament_reteta = array(
            'id_reteta' => $id_reteta,
            'id_medicament' => $id_medicament,
            'pret' => $pret
        );

        $this->db->insert('medicamente_retete', $data_medicament_reteta);
    }

    /*function get_bird($q){
        $this->db->select('*');
        $this->db->like('bird', $q);
        $query = $this->db->get('birds');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $new_row['label']=htmlentities(stripslashes($row['bird']));
                $new_row['value']=htmlentities(stripslashes($row['aka']));
                $row_set[] = $new_row; //build an array
            }
            echo json_encode($row_set); //format the array into json data
        }
    }*/
//    public function getMedicamenteNecompensate($input)
    public function getMedicamente($input)
    {
        $results = $this->db->select('*')->like('nume_medicament', $input, 'after')->get('medicamente_nomenclatoare');

        if ($results->num_rows)
        {
            foreach ($results->result_array() as $row)
            {
                //ce afiseaza in lista de sugestii
                $new_row['label'] = htmlentities(stripslashes($row['nume_medicament']));

                //ce baga in input cand se selecteaza  o sugestie
                $new_row['value'] = htmlentities(stripslashes($row['nume_medicament']));//??nume?

                $new_row['id'] = htmlentities(stripslashes($row['id']));//??nume?

                //build an array
                $row_set[] = $new_row;
            }

            //format the array into json data
            echo json_encode($row_set);
        }
    }

    public function adaugaReteta()
    {
        //?? e null in session pt Secretariat!!! ????
//        $id_sender = $_SESSION['id_lucrator'];

//        $ids_implicati = $_SESSION['ids_implicati'];
//        $text = $_POST['comment'];

        $id_doctor = $_POST["nume_doctor"];
        $id_utilizator = $_SESSION['user_id'];
        $id_pacient = $_POST["nume_doctor"];
        $id_farmacie = $_POST["farmacie"];
//        $id_motive = $_POST["?null?"];
        $id_dosar = $_POST["???"];
        $tip = $_POST["tip_reteta"];
        $data_reteta = $_POST["data_eliberare_reteta"];
        $nr_fisa_inregistrare = $_POST["nume_doctor"];
        $nr_registru_consultatii = $_POST["nr_registru_consultatii"];

        $serie_reteta_compensata = $_POST["serie_reteta_compensata"];
        $nr_reteta_compensata = $_POST["nr_reteta_compensata"];

//        $validitate = $_POST["?null?"];
        $nr_din_dosar = $_POST["nr_reteta_dosar"];

        var_dump($_REQUEST);exit;//!!!!!!!!

        $data_reteta = array(
            //            'id' => AutoIncrement,
            'id_doctor' => $id_doctor,
            'id_utilizator' => $id_utilizator,
            'id_pacient' => $id_pacient,//???
            'id_farmacie' => $id_farmacie,
            'id_motive' => $id_motive,
            'id_dosar' => $id_dosar,
            'tip' => $tip,
            'data_reteta' => $data_reteta,
            'nr_fisa_inregistrare' => $nr_fisa_inregistrare,
            'nr_registru_consultatii' => $nr_registru_consultatii,
            'serie_reteta_compensata' => $serie_reteta_compensata,
            'nr_reteta_compensata' => $nr_reteta_compensata,
            'validitate' => $validitate,
            'nr_din_dosar' => $nr_din_dosar
        );
        $this->db->insert('retete', $data_reteta);

//        $id = $this->db->select('id')->from('comments')->where('nr_intern', $text)->get()->row(0)->id;
        $id_reteta = $this->db->insert_id();

        return $id_reteta;
    }

    public function inregistreazaReteta()
    {
        $id_reteta = $this->adaugaReteta();

        $this->adaugaMedicamentReteta($id_reteta);

        //dosar

        //
//return

    }
}
?>