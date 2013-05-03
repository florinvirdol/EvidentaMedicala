<?php
include 'templates/admin_header.php';
?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >
            <div padding="20px;"><p><?php
                    if ($table != 'log_alerte') {
                        if ($table == 'grade_clasif') {
                            echo 'Grade de clasificare';
                        } elseif ($table == 'indici_arh') {
                            echo 'Indici de arhivare';
                        } elseif ($table == 'servicii') {
                            echo 'Servicii';
                        } elseif ($table == 'stadii') {
                            echo 'Stadii lucrari';
                        } elseif ($table == 'structuri_emitente') {
                            echo 'Structuri emitente';
                        } elseif ($table == 'tipuri_exemplar') {
                            echo 'Tipuri exemplare';
                        } elseif ($table == 'roles') {
                            echo 'Roluri utilizatori';
                        } elseif ($table == 'functionalitati') {
                            echo 'Functionalitati aplicatie';
                        } elseif ($table == 'status_users') {
                            echo 'Status utilizatori';
                        }
                        ?> - <a href="<?php echo base_url(); ?>admin/add_nomenclator/<?php echo $table ?>">Adauga inregistrare noua</a>
                    <?php } ?></p>
                <table class="table table-striped table-bordered dataTable">
                    <?php
                    $nr_curent = 1;
                    foreach ($result as $arrays) {
                        echo '<thead><tr><th>Nr.Crt.</th>';
                        foreach ($arrays as $key => $value) {
                            echo '<th>' . $key . '</th>';
                        }
                        if ($table != 'log_alerte')
                            echo '<th>Optiuni</th>';
                        echo '</tr></thead>';
                        break;
                    } foreach ($result as $array) {
                        $id = $array->id;
                        echo '<tr  ';
                        if ($nr_curent % 2 > 0) {
                            echo 'bgcolor=#F0EFE2';
                        }
                        echo '><td>' . $nr_curent . '</td>';
                        foreach ($array as $item => $value) {
                            echo '<td>' . $value . '</td>';
                        }
                        if ($table != 'log_alerte') {
                            echo '<td><a href="' . base_url() . 'admin/edit_nomenclator/' . $table . '/' . $id . '">Editare</a> | 
  <a href="' . base_url() . 'admin/detele_nomenclator_item/' . $table . '/' . $id . '">Stergere </a> </td>';
                        } echo '</tr>';
                        $nr_curent++;
                    }
                    ?>
                    </ul>
                </table>    
            </div>
        </div>
    </div> 
    <?php
    include 'templates/footer.php';
    ?>
