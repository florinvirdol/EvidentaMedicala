<?php
include 'templates/admin_header.php';
?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >
            <div padding="20px;"><p>Nomenclatoare:
                <ul>
                    <li>
                        <a href="<?php echo base_url();?>admin/get_nomenclator/grade_clasif">Grade de clasificare</a>
                    </li>
                     <li>
                        <a href="<?php echo base_url();?>admin/get_nomenclator/log_alerte">Log alerte</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>admin/get_nomenclator/indici_arh">Indici de arhivare</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>admin/get_nomenclator/servicii">Servicii</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>admin/get_nomenclator/stadii">Stadii lucrari</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>admin/get_nomenclator/structuri_emitente">Structuri emitente</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>admin/get_nomenclator/tipuri_exemplar">Tipuri exemplare</a>
                    </li>      
                    <li>
                        <a href="<?php echo base_url();?>admin/get_nomenclator/roles">Roluri utilizatori</a>
                    </li> 
                    <li>
                        <a href="<?php echo base_url();?>admin/get_nomenclator/functionalitati">Functionalitati aplicatie</a>
                    </li> 
                    <li>
                        <a href="<?php echo base_url();?>admin/get_nomenclator/status_users">Status utilizatori</a>
                    </li> 
                </ul>
                </p>                
            </div>
        </div>
    </div> 
<?php
include 'templates/footer.php';
?>
