<?php include_once'templates/header.php';?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1">
            <center>
                <form id="form_add_lucrari" method="POST" action="<?php echo base_url(); ?>lucrari/add_lucrari" onsubmit="return validateFormOnSubmit_add_lucrari(this)">
                    <table width="900" bgcolor=#F0EFE2>
                        <tbody class="mandatory">
                            <tr>
                                <td align="center"><h4>Adăugare lucrări în sistem</h4></td>
                            </tr>
                            <tr>
                                <td>
                                    Număr intern:
                                    <input id="id_nr_intern" type="text" name="nr_intern"/>
                                    / Data intrare:
<!--                                    <input name="data_intrare" style="width: 75px;" type="text" id="datepicker" class="datepicker">-->
                                    <input name="data_intrare" style="width: 75px;" type="text" id="datepicker" class="_datepicker">
                                    De unde vine lucrarea:
                                    <select name="provenienta" id="provenienta">
                                        <option value="99999">Neselectat</option>
                                        <option value="Condica" selected="selected">Condica</option>
                                        <option value="Serviciu intern">Serviciu intern</option>
                                    </select>                                    
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
                                                <option value="<?=$rows->id;?>" <?=(($rows->id != 1) ? : "selected = 'selected'")?>><?=$rows->name;?></option>";
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    Număr DGCTI:
                                    <input type="text" name="nr_dgcti"/>
                                    / Data DGCTI:
                                    <input name="data_dgcti" style="width: 75px;" type="text" id="datepicker1" class="_datepicker">
<!--                                    <input name="data_dgcti" style="width: 75px;" type="text" id="datepicker1 class="datepicker"">-->
                                    <br>
                                    Tip exemplar:
                                    <select name="id_tip_exemplar">
                                        <option value="99999">Neselectat</option>
                                        <?php
                                            foreach ($tipuri_exemplar->result() as $rows)
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
                                    Structura emitentă:
                                    <select id="id_structura_emitenta" name="id_structura_emitenta">
                                        <option value="99999">Neselectat</option>
                                        <?php
                                            foreach ($structuri_emitente as $rows)
//                                            foreach ($structuri_emitente->result() as $rows)
                                            {
                                        ?>
                                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>";
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    Structura nouă
                                    <input id="structura_emitenta" type="text" name="structura_emitenta"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Număr emitere:
                                    <input type="text" name="nr_emitere"/>
                                    / Data emitere:
                                    <input name="data_emitere" style="width: 75px;" type="text" id="datepicker2" class="_datepicker">
<!--                                    <input name="data_emitere" style="width: 75px;" type="text" id="datepicker2" class="datepicker">-->
                                    Număr pagini:
                                    <input type="text" name="nr_pagini"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Indice de arhivare:
                                    <select name="id_indice_arhivare">
                                        <option value="99999">Neselectat</option>
                                        <?php
                                            foreach ($indici_arh->result() as $rows)
                                            {
                                        ?>
                                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>";
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    Serviciu titular:
                                    <select name="id_serv_titular">
                                        <option value="99999">Neselectat</option>
                                        <?php
                                            foreach ($servicii->result() as $rows)
                                            {
                                        ?>
                                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>";
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <br>
                                    Servicii implicate :
                                    <?php
                                        foreach ($servicii->result() as $rows)
                                        {
                                    ?>
                                            <input type="checkbox" name="id_serviciu_<?php echo $rows->id; ?>" value="<?php echo $rows->id; ?>"> <?php echo $rows->name; ?>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Detaliere lucrare
                                    <br>
<!--                                    <textarea name="detaliere_lucrare"></textarea>-->
                                    <textarea style="width: 100%;" name="detaliere_lucrare" ></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--TODO: - datepicker's refactoring [proba:] nu mai stiu de ce n-a mers prima data, da'apoi am reusit, de revizuit!
                                    <input class="datepickerxxx" name="data_rezolutie" style="width: 75px;" type="text">
                                    <input class="datepickerxxx" name="data_rezolutie" style="width: 75px;" type="text">
                                    <input class="datepickerxxx" name="data_rezolutie" style="width: 75px;" type="text">-->

                                    <?php
                                        if ($_SESSION['user_role'] == '1')
                                        {
                                    ?>
                                            <input type="checkbox" name="spre_repartizare" id="id_spre_repartizare">
                                            <label for="id_spre_repartizare">Spre repartizare |</label>

                                            <label for="id_lucrator_repartizat">Repartizat la:</label>
                                            <select name="id_lucrator_repartizat" id="id_lucrator_repartizat" class="nerepartizate">
                                                <option value="99999">Neselectat</option>
                                                <?php
                                                    foreach ($lucratori->result() as $rows)
                                                    {
                                                ?>
                                                        <option value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>";
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                    <?php
                                        }
                                    ?>
                                    <br>
                                    <label>In colaborare cu:</label>
                                    <table>
                                        <tbody class="optional nerepartizate">
                                            <tr>
                                                <td>

                                                    <?php
                                                        foreach ($lucratori->result() as $lucrator)
                                                        {
                                                            $id = "id_lucrator_" . $lucrator->id;
                                                    ?>
                                                            <input type="checkbox" style="margin:4px;" name="<?=$id;?>" id="<?=$id;?>" value="<?=$lucrator->id;?>" />
                                                            <label for="<?=$id;?>"><?=$lucrator->name;?> |</label>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                        <tbody class="mandatory nerepartizate">
                            <tr>
                                <td>
                                    Rezoluționar intern:
<!--                                    <input type="text" name="rezolutionar_intern" id="xp"/>-->
                                    <input type="text" name="rezolutionar_intern" id="id_rezolutionar_intern"/>
                                    / Data rezoluționării:
<!--                                    <input name="data_rezolutie" style="width: 75px;" type="text" class="datepicker" id="datepicker3">-->
                                    <input name="data_rezolutie" style="width: 75px;" type="text" class="_datepicker" id="id_data_rezolutionarii">
<!--                                    <input name="data_rezolutie" style="width: 75px;" type="text" class="datepicker" id="id_data_rezolutionarii">-->
                                </td>
                            </tr>
                        </tbody>
                        <tbody class="optional nerepartizate">
                            <tr>
                                <td>
                                    <label>Termen lucrare:</label>
                                    <input name="termen" style="width: 75px;" type="text" id="datepicker4" class="_datepicker">
<!--                                    <input name="termen" style="width: 75px;" type="text" id="datepicker4" class="datepicker">-->
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
                        </tbody>
                        <tr>
                            <td><input type="submit" name="trimite" value="Înregistrare lucrare"/></td>
                        </tr>
                    </table>
                </form>
            </center>
        </div>
    </div>
<?php include_once'templates/footer.php'; ?>