<?php include_once'templates/header.php'; ?>
<?php
foreach ($detaliere_lucrare->result() as $rows) {
    $nr_intern = $rows->nr_intern;
    $data_intrare = $rows->data_intrare;
    $provenienta = $rows->provenienta;
    $grad_clasif = $rows->grad_clasif;
    $nr_dgcti = $rows->nr_dgcti;
    $data_dgcti = $rows->data_dgcti;
    $tip_exemplar = $rows->tip_exemplar;
    $structura_emitenta = $rows->structura_emitenta;
    $nr_emitere = $rows->nr_emitere;
    $data_emitere = $rows->data_emitere;
    $nr_pagini = $rows->nr_pagini;
    $indice = $rows->indice;
    $serviciu = $rows->serviciu;
    $detaliere = $rows->detaliere_lucrare;
    $lucrator = $rows->lucrator;
    $rezolutionar = $rows->rezolutionar_intern;
    $data_rezolutie = $rows->data_rezolutie;
    $termen = $rows->termen;
    $stadiu = $rows->stadiu;
    $rezolvare = $rows->rezolvare;
    $data_iesire = $rows->data_iesire;
    $vers = $rows->vers;
    $id_lucrare = $rows->id_lucrari_conexate;
    ;
}
?>
<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >
            <center>
                <form id="form_edit_lucrari" method="POST" action="<?php echo base_url(); ?>sections/update_lucrari" >
                    <input type="hidden" name="vers" value="<?php echo $vers; ?>" />
                    <table width="900">
                        <tbody class="mandatory">
                            <tr>
                                <td align="center">
                                    <h4>
                                        Editare lucrare
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td >Număr intern: <input type="text" name="nr_intern" value="<?php echo $nr_intern; ?>" /> / Data intrare:
                                    <input name="data_intrare"  value="<?php echo $data_intrare; ?>" style="width: 75px;"  type="text" id="datepicker" >
                                    De unde vine lucrarea: <input type="text" name="provenienta" value="<?php echo $provenienta; ?>"  />
                                </td>
                            </tr>
                            <tr>
                                <td > Grad clasificare:
                                    <select name="id_grad_clasif">
                                        <?php foreach ($grade_clasificare->result() as $rows) { ?>
                                            <option value="<?php echo $rows->id; ?>" <?php if ($grad_clasif == $rows->name) echo 'selected="selected"'; ?> ><?php echo $rows->name; ?></option>";
                                        <?php }
                                        ?>            </select> Număr DGCTI: <input type="text" name="nr_dgcti" value="<?php echo $nr_dgcti; ?>"  /> / Data DGCTI: <input value="<?php echo $data_dgcti; ?>" name="data_dgcti" style="width: 75px;"  type="text" id="datepicker1" >  Tip exemplar:
                                    <select name="id_tip_exemplar">
                                        <?php foreach ($tipuri_exemplar->result() as $rows) { ?>
                                            <option value="<?php echo $rows->id; ?>" <?php if ($tip_exemplar == $rows->name) echo 'selected="selected"'; ?> ><?php echo $rows->name; ?></option>";
                                        <?php }
                                        ?>            </select>
                                </td>
                            </tr>
                            <tr>
                                <td >Structura emitentă:
                                    <select name="id_structura_emitenta">

                                        <?php foreach ($structuri_emitente as $r) { ?>
                                            <option value="<?php echo $r->id; ?>" <?php if ($structura_emitenta == $r->name) echo 'selected="selected"'; ?>  ><?php echo $r->name; ?></option>";
                                        <?php }
                                        ?>            </select>
                                </td>
                            </tr>
                            <tr>
                                <td >Număr emitere: <input type="text" name="nr_emitere" value="<?php echo $nr_emitere; ?>" /> / Data emitere:  <input value="<?php echo $data_emitere; ?>" name="data_emitere" style="width: 75px;"  type="text" id="datepicker2" >
                                    Număr pagini: <input type="text" name="nr_pagini" value="<?php echo $nr_pagini; ?>" /></td>
                            </tr>
                            <tr>
                                <td >Indice de arhivare:
                                    <select name="id_indice_arhivare">

                                        <?php foreach ($indici_arh->result() as $rows) { ?>
                                            <option value="<?php echo $rows->id; ?>" <?php if ($indice == $rows->name) echo 'selected="selected"'; ?> ><?php echo $rows->name; ?></option>";
                                        <?php }
                                        ?>            </select>
                                    Serviciu titular:
                                    <select name="id_serv_titular">

                                        <?php foreach ($servicii->result() as $rows) { ?>
                                            <option value="<?php echo $rows->id; ?>" <?php if ($serviciu == $rows->name) echo 'selected="selected"'; ?>  ><?php echo $rows->name; ?></option>";
                                        <?php }
                                        ?>            </select>
                                </td>
                            </tr>
                            <tr>
                                <td >Detaliere lucrare
                                    <br />
                                    <textarea name="detaliere_lucrare" cols="85"><?php echo $detaliere; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td >Repartizat la:
                                    <select name="id_lucrator_repartizat">
                                        <option>Neselectat</option>
                                        <?php foreach ($lucratori->result() as $rows) { ?>
                                            <option value="<?php echo $rows->id; ?>" <?php if ($lucrator == $rows->name) echo 'selected="selected"'; ?>   ><?php echo $rows->name; ?></option>";
                                        <?php }
                                        ?>            </select>
                                    Rezoluționar intern: <input type="text" name="rezolutionar_intern" value="<?php echo $rezolutionar; ?>" /> / Data rezoluționării: <input name="data_rezolutie" style="width: 75px;"  type="text" id="datepicker3" value="<?php echo $data_rezolutie; ?>" ></td>
                            </tr>
                        </tbody>
                        <tbody class="optional">
                            <tr>
                                <td >Termen lucrare: <input name="termen" style="width: 75px;"  type="text" id="datepicker4" value="<?php echo $termen; ?>" >  Stadiu:
                                    <select name="id_stadiu">
                                        <?php foreach ($stadii->result() as $rows) { ?>
                                            <option value="<?php echo $rows->id; ?>" <?php if ($stadiu == $rows->name) echo 'selected="selected"'; ?> ><?php echo $rows->name; ?></option>";
                                        <?php }
                                        ?>            </select>
                                </td>
                            </tr>
                            <tr>
                                <td >Rezolvare
                                    <br />
                                    <textarea name="rezolvare" cols="85"><?php echo $rezolvare; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td >Data ieșire: <input name="data_iesire" style="width: 75px;"  type="text" id="datepicker5" value="<?php echo $data_iesire; ?>"></td>
                            </tr>
                            <tr>
                                <td >Lucrări relaționate:
                                    <select name="id_lucrari_conexate">
                                        <option>Neselectat</option>
                                        <?php foreach ($lucrari->result() as $rows) { ?>
                                            <option value="<?php echo $rows->id; ?>" <?php if ($id_lucrare == $rows->id) echo 'selected="selected"'; ?>><?php echo $rows->nr_dgcti . '/' . $rows->data_dgcti; ?></option>";
                                        <?php }
                                        ?>            </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="trimite" value="Actualizare lucrare" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </center>
        </div>
    </div>

<?php include_once'templates/footer.php'; ?>