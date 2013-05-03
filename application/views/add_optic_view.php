<?php include_once'templates/header.php'; ?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1">
            <center>
<!--                <form id="form_add_optic" method="POST" action="--><?php //echo base_url(); ?><!--lucrari/optic_add"-->
                <form id="form_add_optic" method="POST" action="<?php echo base_url(); ?>lucrari/optic_add/<?=$id_lucrare?>"
                      onsubmit="return validateFormOnSubmit_repartizareLucrari_addVers_addOptic(this)" enctype="multipart/form-data">
                    <input type="hidden" name="id_lucrare" value="<?php echo $id_lucrare;?>"/>
                    <table width="900" bgcolor=#F0EFE2>
                        <tbody class="mandatory">
                            <tr>
                                <td align="center"><h4>Adaugare suport optic</h4></td>
                            </tr>
                            <tr>
                                <td>
                                    Număr:
                                    <input type="text" name="nr" id="id_nr"/>
                                    / Data:
                                    <input name="data" class="_datepicker" style="width: 75px;" type="text" id="datepicker1">
<!--                                    <input name="data" class="datepicker" style="width: 75px;" type="text" id="datepicker1">-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Grad clasificare:
                                    <select name="id_grad_clasif">
                                        <option value="99999">Neselectat</option>
                                        <?php
                                            foreach ($grade_clasificare->result() as $rows)
                                            {
                                        ?>
                                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>";
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    Detaliere
                                    <br/>
<!--                                    <textarea name="detaliere" cols="85"></textarea>-->
                                    <textarea style="width: 100%;" name="detaliere"></textarea>
                                </td>
                            </tr>                            
                            <tr>
                                <td><input type="submit" name="trimite" value="Adaugare fisier"/></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </center>
        </div>
    </div> 
    <?php include_once'templates/footer.php'; ?>