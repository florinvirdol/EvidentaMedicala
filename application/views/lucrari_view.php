<?php include_once'templates/header.php'; ?>

<div id="content_header"></div>
<div id="site_content"> 
    <?php $whereiam = $this->uri->segment('2');
        if($whereiam=="lucrari_personale" || $whereiam=="lucrari_serviciu")
        {
            $qstadii = $this->db->get('stadii');
            $stadii = $qstadii->result();
            //echo "Sortare lucrari dupa status: ";
            foreach ($stadii as $stadiu)
                {
           //     echo "<a href='".  base_url()."lucrari/lucrari_personale_by_status/".$stadiu->id."'>".$stadiu->name."</a> | ";
            }
        }
    ?>
    <div id="tabs">
        <div id="tabs-1">
            <center>

                <?php
                if ($_SESSION['user_role'] == 3)
                {
                ?>

                    <div class="filters" align="left">
                        <h4>Filtrare lucrari</h4>
                        <br>
                        <form id="id_filtrare" method="POST" action="<?php echo base_url(); ?>lucrari/lucrari_serviciu">
                            <input type="checkbox" name="nerepartizate_cbx" id="id_nerepartizate_cbx" <?=(!isset($_POST['nerepartizate_cbx']) ? : "checked = 'checked'")?>>
                            <label class="" for="id_nerepartizate_cbx">Nerepartizate</label>
                            <br>
                            <input type="checkbox" name="repartizate_cbx" id="id_repartizate_cbx" <?=(!isset($_POST['repartizate_cbx']) ? : "checked = 'checked'")?>>
                            <label class="" for="id_repartizate_cbx">Repartizate</label>
                            <br>
                            <label for="id_lucrator_repartizat">Repartizat la:</label>
                            <select name="id_lucrator_repartizat" id="id_lucrator_repartizat" class="nerepartizate" <?=(!isset($_POST['nerepartizate_cbx']) ? : "checked='checked'")?>>
                                <option value="99999">Neselectat</option>
                                <?php
                                    foreach ($lucratori->result() as $rows)
                                    {
                                ?>
                                        <option value="<?=$rows->id;?>" <?=(isset($_POST['id_lucrator_repartizat']) ? (($_POST['id_lucrator_repartizat'] != $rows->id) ? : "selected = 'selected'") : "")?>><?=$rows->name;?></option>";
                                <?php
                                    }
                                ?>
                            </select>
                            <br>
                        </form>

                    </div>

                <?php
                }
                ?>

                <table id="id_lucrari_serviciu" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
                    <thead>
                        <tr>
                            <th><b>Nr.Crt.</b></th>
                            <th><b>Număr intern</b></th>
                            <th><b>Data intrare</b></th>
                            <th><b>Termen</b></th>
                            <th><b>Număr / Data DGCTI</b></th>
                            <th><b>Emitent</b></th>
                            <th><b>Lucrator repartizat</b></th>
                            <th><b>Status</b></th>
                            <th><b>Opţiuni</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $nr = '1';
                            foreach ($evidenta_lucrari as $rows)
                            {
                                $id_lucrare = $rows->id;
                                $nr_intern = $rows->nr_intern.'/'.$rows->data_intrare;

                                $q = $this->db->query('SELECT max(versiune) as maxid FROM versiuni where nr_intern = "' . $nr_intern.'"');

                                $row = $q->row();
                                $max_vers = $row->maxid;

                                $this->db->select('* , stadii.name as stadiu, stadii.color as culoare_stadiu');
                                $this->db->from('versiuni');
                                $this->db->join('stadii', 'stadii.id = versiuni.id_stadiu', 'left');
                                $this->db->where('versiune', $max_vers);
                                $this->db->where('nr_intern', $nr_intern);

                                $stadiu_result = $this->db->get()->row();

                                //unele erori cateodata???? dece? :|
                                //Trying to get property of non-object
                                $stadiu_lucrare = $stadiu_result->stadiu;
                                $stadiu_color = $stadiu_result->culoare_stadiu;


                                $this->db->select('id');
                                $this->db->from('status_citire_lucrari_implicati');
                                $this->db->where('id_lucrare', $id_lucrare);
                                $this->db->where('id_lucrator_implicat', $_SESSION['id_lucrator']);
                                $this->db->where('status', 1);

                                $status_implicati = $this->db->get()->row();


                                //??order_by  status=necitit, doar pt cel logat?!?, la cele in care e implicat cum sortez??

                                //TODO: !! la afisari_unde_order_by: sa tin cont si de ce e in status__implicati

                                //search in status_implicati: id_lucrator = session_id     si     id_lucrare = id_for


                                if ((($rows->id_lucrator_repartizat == $_SESSION['id_lucrator']) && ($rows->id_status_citire == 1))
                                    || (!empty($status_implicati->id)))
                                {
                                    echo "<tr style = \"font-weight: bold; font-size:20px;\">";
                                }
                                else
                                {
                                    echo "<tr>";
                                }


                                //!!sort 1 titular si statu=1
                                // !!     2 sa bag intr-un join... apoi sort de status dn table separata...

                        ?>

                                    <td><?php echo $nr++; ?></td>
                                    <td><?php echo $rows->nr_intern; ?></td>
                                    <td><?php echo $rows->data_intrare; ?></td>
                                    <td><?=(($rows->termen != "0000-00-00") ? $rows->termen : "")?></td>
                                    <td><?php echo $rows->nr_dgcti . ' / ' . $rows->data_dgcti; ?></td>
                                    <td><?php echo $rows->structura_emitenta; ?></td>
                                    <td>
                                        <?php
                                        // sefii de serviciu, au si ei lucrari personale???

                                            $before = $after = "";

                                            if (($_SESSION['user_role'] != 3) && ($_SESSION['user_role'] != 1) && $rows->id_lucrator != $_SESSION['id_lucrator'])
                                            {
                                                $before = "In colaborare cu ";
                                                $after = " (Titular)";
                                            }
                                            echo $before . $rows->lucrator . $after;
                                        ?>
                                    </td>
                                    <td style="color:<?php echo $stadiu_color;?>"><?php echo $stadiu_lucrare;?></td>

<!--                                    <td title="<b>Detaliere lucrare: </b>--><?php //echo $rows->detaliere_lucrare; ?><!--"><a href="--><?php //echo base_url(); ?><!--lucrari/detaliere_lucrare/--><?php //echo $id; ?><!--">Detaliere lucrare</a></td>-->
                                    <td title="Detaliere lucrare: <?php echo $rows->detaliere_lucrare; ?>"><a class="btn" href="<?php echo base_url(); ?>lucrari/detaliere_lucrare/<?=$id_lucrare . "/c"?>">Detaliere lucrare</a></td>
                                </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>

            </center>
        </div>
    </div> 
    <?php include_once'templates/footer.php'; ?>