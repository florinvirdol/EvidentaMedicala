<?php

class Commentsmodel extends CI_Model
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

    public function addComment($id_lucrare)
    {
        //?? e null in session pt Secretariat!!! ????
        $id_sender = $_SESSION['id_lucrator'];

        $ids_implicati = $_SESSION['ids_implicati'];
        $text = $_POST['comment'];

        $data_comment = array(
            'id_lucrare' => $id_lucrare,
            'id_sender' => $id_sender,
            'ids_implicati' => $ids_implicati,
            'text' => $text
        );
        $this->db->insert('comments', $data_comment);

//        $id = $this->db->select('id')->from('comments')->where('nr_intern', $text)->get()->row(0)->id;
        $id = $this->db->insert_id();

        return $id;

        //return id-ul comentariului ultim adaugat
    }

}

?>
