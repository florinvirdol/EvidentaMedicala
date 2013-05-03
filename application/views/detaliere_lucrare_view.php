<?php include_once'templates/header.php'; ?>

<div id="content_header" xmlns="http://www.w3.org/1999/html"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >

            <table bgcolor=#F0EFE2>
                <tr>
                    <td valign="top">
                        <?php
                        //TODO: ma gandesc ca ar trebui/ar fi mai bine sa scoatem foreach-u'de mai jos,
                        // adica: nu e doar o singura "detaliere" ??

                        $id_lucrare = $nr_intern = "";

                        foreach ($detaliere_lucrare as $rows)
                        {
                            $id_lucrare = $rows->id_lucrare;
                            $nr_intern = $rows->nr_intern . "/" . $rows->data_intrare;
                            ?>
                            <h4>Informatii despre lucrare</h4>
                            <center>
                                <table width="600" bgcolor="white">
                                    <tbody class="mandatory">
                                        <tr>
                                            <td>
                                                <b>Număr intern:</b><?php echo $rows->nr_intern; ?>/
                                                <b>Data intrare</b>:<?php echo $rows->data_intrare; ?>|
                                                <b>Proveniență lucrarea:</b><?php echo $rows->provenienta; ?>
                                                </br>
                                                <b>Grad clasificare:</b><?php echo $rows->grad_clasif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>Număr DGCTI:</b><?php echo $nr_dgcti = $rows->nr_dgcti; ?>/
                                                <b>Data DGCTI:</b><?php echo $rows->data_dgcti; ?>
                                                </br>
                                                <b>Tip exemplar:</b><?php echo $rows->tip_exemplar; ?> |
                                                <b>Structura emitentă:</b><?php echo $rows->structura_emitenta; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>Număr emitere:</b><?php echo $rows->nr_emitere; ?> /
                                                <b>Data emitere:</b><?php echo $rows->data_emitere; ?>
                                                </br>
                                                <b>Număr pagini:</b><?php echo $rows->nr_pagini; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>Indice de arhivare:</b><?php echo $rows->indice . '-' . $rows->indice_detail; ?>|
                                                <br>
                                                    <b>Serviciu titular:</b><?php echo $rows->serviciu; ?>
                                                    <br>
                                                        <b>Servicii implicate :</b>
                                                        <ul>
                                                            <?php
                                                            $id_servicii_implicate = $rows->servicii_implicate;

                                                            $result_nume_servicii = $this->usermodel->getNames($id_servicii_implicate, "servicii");

                                                            foreach ($result_nume_servicii as $s) {
                                                                echo '<li>' . $s->name . '</li>';
                                                            }
                                                            echo '</ul>';
                                                            ?>
                                                            </td>
                                                            </tr>
                                                            <tr>
<!--                                                                <td><b>Detaliere lucrare: </b>--><?php //echo $rows->detaliere_lucrare; ?><!--</td>-->
                                                                <td class="detaliere"><b>Detaliere lucrare: </b><?php echo $rows->detaliere_lucrare; ?></td>
                                                            </tr>
                                                            </tbody>

                                                            <!--                                            ////if nerepartizat  ??? id_lucrator_repartizat sau lucrator?? -->
                                                            <?php
                                                            if ($rows->id_lucrator_repartizat != 99999) {
                                                                ?>
                                                                <tbody class="madatory nerepartizate">
                                                                    <tr>
                                                                        <td>
                                                                            <b>Repartizat la:</b><?php echo $rows->lucrator; ?>

                                                                            <?php
                                                                            $id_lucratori_implicati = $rows->id_lucratori_implicati;

                                                                            if (strpos($id_lucratori_implicati, '-') !== false) {
                                                                                $result_nume_lucratori = $this->usermodel->getNames($id_lucratori_implicati, "lucratori");

                                                                                echo "In colaborare cu: ";

                                                                                foreach ($result_nume_lucratori as $name_lucrator) {
                                                                                    echo $name_lucrator->name . " | ";
                                                                                }
                                                                            }

                                                                            /*
                                                                             * //TODO : de ce era asa? :-?
                                                                             * if ($rows->id_lucrator != $_SESSION['id_lucrator'])
                                                                              {
                                                                              $id_lucratori_implicati = $rows->id_lucratori_implicati;

                                                                              if (strpos($id_lucratori_implicati, '-') !== false)
                                                                              {
                                                                              $result_nume_lucratori = $this->usermodel->getNames($id_lucratori_implicati, "lucratori");

                                                                              echo "In colaborare cu: ";

                                                                              foreach ($result_nume_lucratori as $name_lucrator)
                                                                              {
                                                                              echo $name_lucrator->name . " | ";
                                                                              }
                                                                              }
                                                                              } */
                                                                            ?>
                                                                            </br>
                                                                            <!--                                                    asta nu trebuie afisat,
                                                                                                                                        !!!! ci setat, in functie de utilizator si data-->
                                                                            <b>Rezoluționar intern:</b><?php echo $rows->rezolutionar_intern; ?> /
                                                                            <b>Data rezoluționării:</b> <?php echo $rows->data_rezolutie; ?>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                                <tbody class="optional nerepartizat">
                                                                    <tr>
                                                                        <td>
                                                                            <b>Termen lucrare:</b>
                                                                            <?php
                                                                            $termen = $rows->termen;
                                                                            if ($termen == "0000-00-00") {
                                                                                echo "nestabilit";
                                                                            } else {
                                                                                echo $termen;
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                                <?php
                                                            }
                                                            ?>
                                                            <tbody class="optional">
                                                                <tr>
                                                                    <td>

                                                                        <?php
                                                                        $this->load->model('lucrarimodel');
                                                                        $results = $this->lucrarimodel->get_lucrari_relationate($nr_intern);
                                                                        {
                                                                            if ($results->num_rows() > 0) {
                                                                                echo '<b>Lucrări relaționate:</b>
                                                                        </br>';
                                                                                foreach ($results->result() as $i) {
                                                                                    $nr_secundara = $i->nr_intern_lucrare_secundara;
                                                                                    $nr_principala = $i->nr_intern_lucrare_principala;
                                                                                    if ($nr_secundara != $nr_intern)
                                                                                        echo '<a href="' . base_url() . 'lucrari/get_lucrare_detail_by_nr/'.$nr_secundara.'">' . $nr_secundara . '</a></br>';
                                                                                    if ($nr_principala != $nr_intern)
                                                                                        echo '<a href="' . base_url() . 'lucrari/get_lucrare_detail_by_nr/'.$nr_principala.'">' . $nr_principala . '</a></br>';
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
    <?php if (isset($_SESSION['lucrare_baza']) && $_SESSION['lucrare_baza'] != $nr_intern) { ?>
<!--                                                                            <a href="--><?php //echo base_url(); ?><!--lucrari/connect_lucrare/--><?php //echo $nr_intern; ?><!--">Conexarea cu lucrarea selectata</a>-->
                                                                            <a href="<?php echo base_url(); ?>lucrari/connect_lucrare/<?php echo $nr_intern . "/" . $id_lucrare; ?>">Conexarea cu lucrarea selectata</a>
    <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                            </table>
                                                            </center>
    <?php
    if (($rows->id_lucrator_repartizat == 99999) && ($_SESSION['user_role'] == '3')) {
        ?>
                                                                <h4>Repartizare lucrare</h4>

                                                                <!--                                            TODO:!!! Refactorizare: =>  cu div-uri in loc de tabele...tr...d.. -->
                                                                <center>

                                                                    <!--                                            TODO: UPDATE!!
                                                                                                                    TODO: pop-up : title_detaliere:
                                                                                                                            http://fancybox.net/howto
                                                                                                                            http://fancyapps.com/fancybox/
                                                                    -->
                                                                    <form id="form_actualizare_lucrari" method="POST" action="<?= base_url(); ?>lucrari/repartizare_lucrare/<?= $id_lucrare ?>" onsubmit="return validateFormOnSubmit_repartizareLucrari_addVers_addOptic(this)">
                                                                        <table width="600" bgcolor="white">
                                                                            <tbody class="mandatory">
                                                                                <tr>
                                                                                    <td>
                                                                                        <label for="id_lucrator_repartizat">Repartizat la:</label>
                                                                                        <select name="id_lucrator_repartizat" id="id_lucrator_repartizat" class="nerepartizate">
                                                                                            <option value="99999">Neselectat</option>
                                                                                            <?php
                                                                                            foreach ($lucratori->result() as $rows) {
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
                                                                                <td>
                                                                                    <label>In colaborare cu:</label>
                                                                                    <table>
                                                                                        <tbody class="optional nerepartizate">
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <?php
                                                                                                    foreach ($lucratori->result() as $lucrator) {
                                                                                                        $id = "id_lucrator_" . $lucrator->id;
                                                                                                        ?>
                                                                                                        <input type="checkbox" style="margin:4px;" name="<?= $id; ?>" id="<?= $id; ?>" value="<?= $lucrator->id; ?>" />
                                                                                                        <label for="<?= $id; ?>"><?= $lucrator->name; ?> |</label>

                                                                                                                        <!--<label for="<? /* =$id; */ ?>"><? /* =$lucrator->name; */ ?>
                                                                                                                            <input type="checkbox" style="margin:4px;" name="<? /* =$id; */ ?>" id="<? /* =$id; */ ?>" value="<? /* =$lucrator->id; */ ?>" />|
                                                                                                                        </label>-->
            <?php
        }
        ?>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <label>Termen lucrare:</label>
                                                                                    <input class="_datepicker" name="termen" style="width: 75px;" type="text" id="id_datepicker_termen">
                                                                                </td>
                                                                            </tr>
                                                                            <tbody class="mandatory">
                                                                                <tr>
                                                                                    <td>
                                                                                        <label for="id_comentariu">Comentariu:</label>
        <!--                                                                                    <textarea name="comentariu" id="id_comentariu" cols="85"></textarea>-->
                                                                                        <textarea name="comentariu" id="id_comentariu" style="width: 100%;" ></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                            <tr><td><input type="submit" value="Actualizare"></td></tr>
                                                                        </table>
                                                                    </form>
                                                                </center>
                                                                <?php
                                                            }
                                                            ?>


                            <div id="comments_section">
                                    <h4>Comentarii</h4>

<!--                                TODO: ??  cine view/add commentemn-->

                                    <?php
//                                        daca lucrarea are comentarii: afisez
                                $_SESSION['ids_implicati'] = $rows->lucratori_implicati;

                                if ($comments_lucrare)
                                        {
                                    ?>
                                            <div id="view_comments">
                                                <?php
                                                    foreach($comments_lucrare as $comment)
                                                    {
                                                        $nume_sender = $this->usermodel->getNames($comment->id_sender, "lucratori");
                                                        $nume_sender = $nume_sender[0]->name;

                                                        echo "<div id=\"comment_$comment->id\">
                                                                    De la: $nume_sender
                                                                    \nIn data: $comment->time
                                                                    \nTextul: $comment->text
                                                              </div>";
                                                    }
                                                ?>
                                            </div>
                                            <br>
                                    <?php
                                        }
                                    ?>

                                    <div id="add_send_comments_form">
                                        <input id="add_comments" class="btn" type="submit" value="Adauga Comentariu">

<!--                                        <form id="send_comments" method="post" style="display: none" action="--><?//=base_url()?><!--lucrari/add_comment/--><?//=$id_lucrare?><!--">-->
                                        <form id="send_comments" method="post" style="display: none" action="<?=base_url()?>lucrari/add_comment/<?=$id_lucrare?>" onsubmit="return validateCommentLength()">
                                            <input class="btn" type="submit" value="Trimite Comentariu">
                                            <br>
<!--                                            TODO: alte formulare: html5 required sau codeigniter validateforms... !!-->
<!--                                            <textarea id="comment" name="comment" required title="Introduceti comentariul"></textarea>-->
                                            <textarea id="comment" name="comment" title="Introduceti comentariul"></textarea>
                                        </form>
                                        <p id="comment_error" style="color: red"><b>Lungimea comentariului trebuie sa fie de minim 7 caractere!</b></p>
                                    </div>

                            </div>

<?php

    }
?>





                                                        </td>

                                                        <td width="300" valign="top">
                                                            <h4>Versiuni ale lucrarii</h4>


                                                            <a href="<?php echo base_url(); ?>lucrari/vers_add/<?= $nr_intern . "/" . $id_lucrare ?>">Adaugare versiune noua</a>

                                                            <br>
                                                            <br>

                                                                <div id="accordion">
                                                                    <?php
                                                                    $this->db->where('versiuni.nr_intern', $nr_intern);
                                                                    $this->db->select('* ,versiuni.id as id, stadii.name as stadiu, stadii.color as culoare_stadiu');
                                                                    $this->db->from('versiuni');
                                                                    $this->db->join('stadii', 'stadii.id = versiuni.id_stadiu', 'left');
                                                                    $this->db->order_by("versiuni.versiune", "desc");
                                                                    $query = $this->db->get();
                                                                    $vers = $query->result();

                                                                    foreach ($vers as $v) {
                                                                        $id_vers = $v->id;

                                                                        echo '<h3>' .
                                                                            'Versiune: <b>' . $v->versiune . '</b>' .
                                                                            ' - Stadiu: <b class="stadii_colors" id="'. $v->culoare_stadiu . '">'  . $v->stadiu . '</b>' .
                                                                            '</h3><div>' .
                                                                            'Comentariu: ' . $v->rezolvare .
                                                                            '<br>Data: ' . $v->data_operare .
                                                                            '<br>Fisiere atasate: ';

                                                                        $this->db->where('id_vers', $id_vers);
                                                                        $query_files = $this->db->get('files');
                                                                        $query_files = $query_files->result();
                                                                        echo "<ul>";

                                                                        foreach ($query_files as $f) {
                                                                            echo '<li><a class="not_btn" href="' . base_url() . 'files/' . $f->name . '" target="blank">' . $f->name . '</a></li>';
                                                                        }
                                                                        echo '</ul><a href="' . base_url() . 'lucrari/file_add/' . $id_vers . "/" . $id_lucrare . '">Adaugare fisier</a>';
                                                                        if (!isset($_SESSION['lucrare_baza'])) {
//                                                                            echo '| <a href="' . base_url() . 'lucrari/select_lucrare_connect/' . $id_vers . '/' . $nr_intern . '/' . $id_lucrare . '">Selectare pentru conexare</a>';
                                                                            echo '<br> <a href="' . base_url() . 'lucrari/select_lucrare_connect/' . $id_vers . '/' . $nr_intern . '/' . $id_lucrare . '">Selectare pentru conexare</a>';
                                                                        }
                                                                        echo '</div>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </br>
                                                            <h4>Suporti optici</h4>
                                                            <a href="<?php echo base_url(); ?>lucrari/optic_add/<?= $id_lucrare ?>">Adaugare suport optic</a>
                                                            </br>
                                                            <?php
                                                            $this->db->where('suporti_optici.id_lucrare', $id_lucrare);
                                                            $this->db->select('* ,grade_clasif.name as grad_clasif');
                                                            $this->db->from('suporti_optici');
                                                            $this->db->join('grade_clasif', 'grade_clasif.id = suporti_optici.id_grad_clasif', 'left');
                                                            $query = $this->db->get();

                                                            if ($query->num_rows() > 0) {
                                                                $cd = $query->result();
                                                                foreach ($cd as $c) {
                                                                    echo
                                                                    '<table bgcolor=white>
                                            <tr>
                                                <td>
                                                    Numar: ' . $c->nr . '/' . $c->data .
                                                                    '</br>
                                                    Grad de clasificare: ' . $c->grad_clasif .
                                                                    '</br>
                                                    Descriere: ' . $c->descriere .
                                                                    '</td>
                                            <tr>
                                        </table>';
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        </tr>

                                                        <!--                TODO: daca scoatem foreach de sus, punem repartizare aici:.. in alta linie-->
                                                                        <!--<tr>
                                                                            <td>
                                                        
                                                                            </td>
                                                                        </tr>-->
                                                        </table>
                                                        </div>
                                                        </div>

<?php include_once'templates/footer.php'; ?>