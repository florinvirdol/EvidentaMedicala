<?php
include 'templates/admin_header.php';
?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >
            <div padding="20px;"><p>Management acces:</p>                
                <table border="1" width="960"><tr><td>Functionalitati \ Roluri</td>
                        <?php
                        foreach ($roluri->result() as $item) {
                            echo '<td>' . $item->name . '</td>';
                        }
                        echo '<td>Optiuni</td></tr>'; ///antet tabel
                        foreach ($functionalitati->result() as $f) {
                            $cod = $f->cod;
                            echo '<form action="' . base_url() . 'admin/update_acces" method="POST">
                                
                                <tr><td>' . $f->denumire . '</td>';
                            foreach ($roluri->result() as $item) {
                                echo '<td>';
                                $id_role = $item->id;
                                $this->db->where('cod_functie', $cod);
                                $this->db->where('id_user', $id_role);
                                $this->db->where('status', '2');
                                $q = $this->db->get('access');
                                $rez = $q->num_rows();
                                if ($rez > 0) {
                                    echo '<input type="radio" name="' . $cod . '-' . $id_role . '" value="permis" checked> Da<br>
                                          <input type="radio" name="' . $cod . '-' . $id_role . '" value="nepermis" >Nu';

                                    
                                } else {
                                    echo '<input type="radio" name="' . $cod . '-' . $id_role . '" value="permis" > Da<br>
                                          <input type="radio" name="' . $cod . '-' . $id_role . '" value="nepermis" checked>Nu';

                                }
                                echo'</td>';
                            }
                            echo '<td>
                                <input type="submit" value="actualizare" />
                                </td></tr></form>';
                        }
                        ?></table>
            </div>
        </div>
    </div> 
    <?php
    include 'templates/footer.php';
    ?>
