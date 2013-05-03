<?php
include 'templates/admin_header.php';
?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >
            <div padding="20px;">
                <p>Editare <?php
            if($table=='grade_clasif'){
                echo 'Grade de clasificare';
            }elseif($table=='indici_arh'){
                echo 'Indici de arhivare';
            }elseif($table=='servicii'){
                echo 'Servicii';
            }elseif($table=='stadii'){
                echo 'Stadii lucrari';
            }elseif($table=='structuri_emitente'){
                echo 'Structuri emitente';
            } elseif($table=='tipuri_exemplar'){
                echo 'Tipuri exemplare';
            } elseif($table=='roles'){
                echo 'Roluri utilizatori';
            }      elseif($table=='functionalitati'){
                echo 'Functionalitati aplicatie';
            }              
            ?></p>
                    <table style="border: 1px solid grey;">
                        <form action="<?php echo base_url();?>admin/edit_nomenclator" method="POST">
                            <input type="hidden" name="table" value="<?php echo $table;?>" />
                            <input type="hidden" name="id" value="<?php echo $id_lucrare;?>" />
                        <?php
                foreach ($result as $arrays) {
                    echo '<tr>';
            foreach ($arrays as $key => $value) {                
                    if($key!='id') echo '<td>' . $key . ' <input type="text" name="' . $key . '" value="'.$value.'"></td>';
                
                }   echo '</tr>';
            break; }
            ?> <tr><td><input type="submit" value="Trimite"/></td></tr>
                </form>
                    </table>    
            </div>
        </div>
    </div> 
<?php
include 'templates/footer.php';
?>
