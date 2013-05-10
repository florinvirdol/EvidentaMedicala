<?php include_once'templates/header.php';?>

    <div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1">

            <?php echo validation_errors(); ?>

            <div id="errorContainer">
                <p>Sunteti rugat sa rezolvati urmatoarele probleme si sa incercati din nou:</p>
                <ul />
            </div>


            <!--            --><?php //echo form_open('lucrari/adauga_reteta'); ?>
            <?php
            $attributes = array('id' => 'salveazaRetetaForm');
            echo form_open('lucrari/salveazaReteta', $attributes);
            ?>
            <div id="form_content" class="info_reteta">
                <fieldset id="info_generale" class="info_reteta">
                    <legend>Informații Generale</legend>
                    <label for="tip_reteta">Tip Rețetă</label>
                    <select name="tip_reteta" id="tip_reteta" onchange="schimba_tip_retea(this.value)" class="<?=form_error('tip_reteta') ? "error" : ""?>">
                        <!--                            <option value="99999">Neselectat</option>-->
                        <option value="">Neselectat</option>
                        <option value="1" >Compensată</option>
                        <option value="0">Necompensată</option>
                    </select>
                    <label for="nume_doctor">Doctor</label>
                    <select name="nume_doctor" id="nume_doctor" class="<?=form_error('nume_doctor') ? "error" : ""?>">
                        <!--                            <option value="99999">Neselectat</option>-->
                        <option value="">Neselectat</option>
                        <?php
                        foreach ($doctori as $doctor)
                        {
                            echo "<option value='$doctor->id'>$doctor->nume $doctor->prenume</option>";
                        }
                        ?>
                    </select>
                    <label for="data_eliberare_reteta">Data Eliberare Rețetă</label>
                    <input type="text" name="data_eliberare_reteta" class="_datepicker" style="width: 75px;" value="<?=set_value('data_eliberare_reteta')?>" class="<?=form_error('data_eliberare_reteta') ? "error" : ""?>">
                    <br>
                    <label for="nr_fisa_pacient">Nr. Fișă Pacient</label>
                    <input type="text" name="nr_fisa_pacient" value="<?=set_value('nr_fisa_pacient')?>" class="<?=form_error('nr_fisa_pacient') ? "error" : "nr_lit"?>">
                    <label for="nr_registru_consultatii">Nr. Registru Consultații</label>
                    <input type="text" name="nr_registru_consultatii" value="<?=set_value('nr_registru_consultatii')?>" class="<?=form_error('nr_registru_consultatii') ? "error" : "nr"?>">
                    <br>
                    <label for="nr_dosar">Nr. Dosar</label>
                    <select name="nr_dosar" id="nr_dosar" class="<?=form_error('nr_dosar') ? "error" : ""?>">
                        <!--                            <option value="99999">Neselectat</option>-->
                        <option value="">Neselectat</option>
                        <?php
                        foreach (range(1, 20) as $index)
                        {
                            echo "<option value='$index'>$index</option>";
                        }
                        ?>
                    </select>
                    <label for="farmacie">Farmacie</label>
                    <select name="farmacie" id="farmacie" class="<?=form_error('farmacie') ? "error" : ""?>">
                        <!--                            <option value="99999">Neselectat</option>-->
                        <option value="">Neselectat</option>
                        <?php
                        foreach ($farmacii as $farmacie)
                        {
                            echo "<option value='$farmacie->id'>$farmacie->nume</option>";
                        }
                        ?>
                    </select>
                </fieldset>
                <fieldset id="info_doar_compensata" class="info_reteta" style="display: none;">
                    <legend>Specific Compensata</legend>
                    <div id="info_specific_compensata">
                        <label for="serie_reteta_compensata">Serie Rețetă Compensată</label>
                        <input type="text" name="serie_reteta_compensata" value="<?=set_value('serie_reteta_compensata')?>" class="<?=form_error('serie_reteta_compensata') ? "error" : "lit"?>">
                        <label for="nr_reteta_compensata">Nr. Rețetă Compensată</label>
                        <input type="text" name="nr_reteta_compensata" value="<?=set_value('nr_reteta_compensata')?>" class="<?=form_error('nr_reteta_compensata') ? "error" : "nr"?>">
                    </div>
                </fieldset>
                <fieldset id="info_pacienti" class="info_reteta">
                    <legend>Pacient</legend>
                    <label for="cnp_pacient">CNP</label>
                    <input type="text" name="cnp_pacient" value="<?=set_value('cnp_pacient')?>" class="<?=form_error('cnp_pacient') ? "error" : "nr"?>">
                    <br>
                    <label for="nume_pacient">Nume</label>
                    <input type="text" name="nume_pacient" value="<?=set_value('nume_pacient')?>" class="<?=form_error('nume_pacient') ? "error" : "lit"?>">
                    <label for="prenume_pacient">Prenume</label>
                    <input type="text" name="prenume_pacient" value="<?=set_value('prenume_pacient')?>" class="<?=form_error('prenume_pacient') ? "error" : "lit"?>">
                    <label for="cod_pacient">Cod Asigurat</label>
                    <input type="text" name="cod_pacient" value="<?=set_value('cod_pacient')?>" class="<?=form_error('cod_pacient') ? "error" : "nr"?>">
                </fieldset>
                <fieldset id="info_medicamente" class="info_reteta">
                    <legend>Medicamente</legend>
                    <div id="m_c" style="display: none;">
                        <div id="medicamente_compensate">
                            <fieldset id="info_medicament_c_1">
                                <legend>Medicament 1</legend>
                                <input type="hidden" name="hidden_ids_medicamente_c_[1]" id="hidden_id_medicament_c_1">
                                <label for="international_medicamente_c_[1]">Nume Internațional</label>
                                <input type="text" name="international_medicamente_c_[1]" class="autocomplete lit">
                                <label for="comercial_medicamente_c_[1]">Nume Comercial</label>
                                <input type="text" name="comercial_medicamente_c_[1]" class="lit">
                                <br>
                                <label for="vals_amanunt_medicamente_c_[1]">Valoare Amanunt</label>
                                <input type="text" name="vals_amanunt_medicamente_c_[1]" class="nr">
                                <label for="vals_compensat_medicamente_c_[1]">Valoare Compensat</label>
                                <input type="text" name="vals_compensat_medicamente_c_[1]" class="nr">
                                <br>
                            </fieldset>
                        </div>
                        <input type="button" name="adauga_medicament_compensat" class="btn" value="Adaugă Alt Medicament" onclick="adauga_medicament_compensat_element()">
                        <input type="button" name="sterge_medicament_compensat" id="sterge_medicament_compensat" class="btn" value="Sterge medicament" onclick="sterge_medicament_element(1)">
                    </div>
                    <div id="m_nc" style="display: none;">
                        <div id="medicamente_necompensate">
                            <fieldset id="info_medicament_nc_1">
                                <legend>Medicament 1</legend>
                                <input type="hidden" name="hidden_ids_medicamente_nc_[1]" id="hidden_id_medicament_nc_1">
                                <label for="medicamente_nc_[1]">Nume Comercial</label>
                                <input type="text" name="medicamente_nc_[1]" id="medicament_nc_1" class="autocomplete lit">
                                <label for="vals_medicamente_nc_[1]">Valoare</label>
                                <input type="text" name="vals_medicamente_nc_[1]" class="nr">
                                <br>
                            </fieldset>

                        </div>
                        <input type="button" name="adauga_medicament" class="btn" value="Adaugă Alt Medicament" onclick="adauga_medicament_element()">
                        <input type="button" name="adauga_medicament" id="adauga_medicament" class="btn" value="Sterge medicament" onclick="sterge_medicament_element(0)">
                    </div>
                </fieldset>
                <div class="info_reteta" style="margin-top:1.5em;">
                    <input type="submit" value="Adaugă Re?etă">
                </div>
            </div>
            </form>

        </div>
    </div>
<?php include_once'templates/footer.php'; ?>