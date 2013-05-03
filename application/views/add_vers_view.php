<?php include_once'templates/header.php'; ?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1">
            <center>
<!--                <form id="form_add_lucrari" method="POST" action="--><?php //echo base_url(); ?><!--lucrari/vers_add"-->
                <form id="form_add_lucrari" method="POST" action="<?=base_url()?>lucrari/vers_add/<?=$nr_intern . "/" . $id_lucrare?>"
                      onsubmit="return validateFormOnSubmit_repartizareLucrari_addVers_addOptic(this)">

<!--                    nu cred ca mai e folosit dupa : name=nr_intern... -->
                    <!--                    <input type="hidden" name="nr_dgcti" value="--><?php //echo $nr_intern;?><!--"/>-->
                    <input type="hidden" name="nr_intern" value="<?php echo $nr_intern;?>"/>

                    <table width="900" bgcolor=#F0EFE2>
                        <tbody class="mandatory">
                            <tr><td align="center"><h4>Adăugare versiune noua a lucrarii</h4></td></tr>
                            <tr>
                                <td>
                                    Stadiu:
                                    <select name="id_stadiu">
                                        <option value="99999">Neselectat</option>
                                        <?php
                                            foreach ($stadii->result() as $rows)
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
                                    <br>
<!--                                    <textarea name="detaliere" cols="85"></textarea>-->
                                    <textarea name="detaliere" style="width: 100%;"></textarea>
                                </td>
                            </tr>
                            <tr><td><input type="submit" name="trimite" value="Adaugare versiune"/></td></tr>
                        </tbody>
                    </table>
                </form>
            </center>
        </div>
    </div> 
    <?php include_once'templates/footer.php'; ?>