<?php include_once'templates/header.php'; ?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >
            <center>
                <!--                <form method="POST" action="--><?php //echo base_url();  ?><!--lucrari/cauta_lucrari" onsubmit="return validateFormOnSubmit(this)" >-->
                <form method="POST" action="<?php echo base_url(); ?>lucrari/cauta_lucrari" onsubmit="return validateFormOnSubmit_add(this)" >
                    <table width="900" bgcolor=#F0EFE2>
                        <tr><td align="center" colspan="4"><h4>Căutare lucrări</h4></td></tr>

                        <tr>
                            <td >                                
                                <label for="numar">                                
                                <input id="numar" type="radio" name="group1" value="numar" checked="checked" onclick="changedRadioBtn(1)"> Număr</label></td>
                            <td>
                                <select name="tip_numar_cautare">
                                    <option value="99999">Neselectat</option>
                                    <option value="nr_intern">Intern</option>
                                    <option value="nr_dgcti">DGCTI</option>
                                    <option value="nr_emitere">Emitent</option>
                                </select>
                            </td>
                            <td colspan="3"><input type="text" name="nr_cautare"  /></td>
                        </tr>

                        <tr>
                            <td >
                                <label for="structura_emitenta">  
                                <input id="structura_emitenta" type="radio" name="group1" value="structura_emitenta" onclick="changedRadioBtn(2)"> Structura emitentă</label></td>
                            <td>
                                <select name="id_structura_emitenta">
                                    <option value="99999">Neselectat</option>
                                    <?php foreach ($structuri_emitente as $rows) { ?>
                                        <option value="<?php echo $rows->id; ?>" ><?php echo $rows->name; ?></option>";
                                    <?php } ?>
                                </select>
                            </td>
                            <td >Detaliere lucrare: </td>
                            <td><textarea name="detaliere_lucrare" cols="55"></textarea></td>
                        </tr>

                        <tr>
                            <td colspan="4"><input type="submit" name="trimite" value="trimite solicitarea" /></td>
                        </tr>
                    </table>
                    <?php if (isset($eroare)) echo $eroare; ?>
                </form>
            </center>
        </div>
    </div> 
    <?php include_once'templates/footer.php'; ?>