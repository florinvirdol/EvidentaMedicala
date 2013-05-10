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

    public function insertReteta()
    {
        //?? e null in session pt Secretariat!!! ????
//        $id_sender = $_SESSION['id_lucrator'];

        $id_utilizator = $_SESSION['user_id'];
        $id_doctor = $_POST["nume_doctor"];
        $id_farmacie = $_POST["farmacie"];
        $nr_dosar = $_POST["nr_dosar"];//!!

//Pacient : cnp, nume prenume ??
//        $id_pacient = $_POST["__pacient"];

//        $cnp_pacient = $_POST["cnp_pacient"];
//        $nume_pacient = $_POST["nume_pacient"];
//        $prenume_pacient = $_POST["prenume_pacient"];

        $tip = $_POST["tip_reteta"];
        $data_reteta = $_POST["data_eliberare_reteta"];
        $nr_fisa_pacient = $_POST["nr_fisa_pacient"];
        $nr_registru_consultatii = $_POST["nr_registru_consultatii"];

        $serie_reteta_compensata = $_POST["serie_reteta_compensata"];
        $nr_reteta_compensata = $_POST["nr_reteta_compensata"];

        $validitate = "-1";//!nu a fost inca vertificata ... validata!

//        $id_motive = $_POST["?null?"];


//        var_dump($_REQUEST);exit;//!!!!!!!!


        $data_reteta = array(
            //            'id' => AutoIncrement,
            'id_utilizator' => $id_utilizator,
            'id_doctor' => $id_doctor,
            'id_farmacie' => $id_farmacie,
//            'id_pacient' => $id_pacient,//???
            'nr_dosar' => $nr_dosar,
            'tip' => $tip,
            'data_reteta' => $data_reteta,
            'nr_fisa_pacient' => $nr_fisa_pacient,
            'nr_registru_consultatii' => $nr_registru_consultatii,
            'serie_reteta_compensata' => $serie_reteta_compensata,
            'nr_reteta_compensata' => $nr_reteta_compensata,
            'validitate' => $validitate
//            'id_motive' => $id_motive,
        );
        $this->db->insert('retete', $data_reteta);

//        $id = $this->db->select('id')->from('comments')->where('nr_intern', $text)->get()->row(0)->id;
        $id_reteta = $this->db->insert_id();

        return $id_reteta;
    }

//    public function insertMedicamentReteta($id_reteta)
    public function insertMedicamentReteta($id_reteta, $id_medicament, $id_nomenclator, $val_amanunt, $val_compensat)
    {
        $val_decont = $val_amanunt - $val_compensat;

        $data_medicament_reteta = array(
            'id_reteta' => $id_reteta,
            'id_medicament' => $id_medicament,
            'id_nomenclator' => $id_nomenclator,
            'valoare_amanunt' => $val_amanunt,
            'valoare_compensat' => $val_compensat,
            'valoare_decont' => $val_decont
        );

        $this->db->insert('medicamente_retete', $data_medicament_reteta);
    }

    public function inregRetetaSiMedicamente($tip_reteta)
    {
        $id_reteta = $this->insertReteta();

    //inreg toate medicamentele unei retete

        $nr_med = $tip_reteta ? count($_POST["medicamente_c_"]) : count($_POST["medicamente_nc_"]);

        for ($i = 1; $i <= $nr_med; $i++)
        {
            $id_medicament  = $tip_reteta ? $_POST["hidden_ids_medicamente_c_"]   : $_POST["hidden_ids_medicamente_nc_"];
            $id_nomenclator = 0;
        //fctie separata, sau mai degraba mai fac un hidden, si incerc sa il obtin atunci!!
//            $id_nomenclator = $tip_reteta ? $_POST["medicamente_c_"]              : $_POST["medicamente_nc_"];
            $val_amanunt    = $tip_reteta ? $_POST["vals_amanunt_medicamente_c_"] : $_POST["vals_medicamente_nc_"];
            $val_compensat  = $tip_reteta ? $_POST["vals_amanunt_medicamente_c_"] : 0;

            $this->insertMedicamentReteta($id_reteta, $id_medicament, $id_nomenclator, $val_amanunt, $val_compensat);
        }
    }
}
?>