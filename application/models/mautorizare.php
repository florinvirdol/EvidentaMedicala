<?php

class Mautorizare extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    function autorizeaza($cod)
    {
        //TODO: id_user = id_ROL!!
        $this->db->where('id_user', $_SESSION['user_role']);
        $this->db->where('cod_functie', $cod);
        $this->db->not_like('status', '1');
        $query = $this->db->get('access');

        if ($query->num_rows() <= 0)
        {
            redirect('welcome/neautorizat');
        }
    }
}

?>
