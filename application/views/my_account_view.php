<?php include_once'templates/header.php'; ?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >
            <a href="<?php echo base_url(); ?>welcome/update_pass">Schimbare parola</a> | 
            <a href="<?php echo base_url(); ?>welcome/edit_account">Editare informatii personale</a>
<?php 
if($person_details->num_rows()<0){
    
}else{
    $result = $person_details->result();
    foreach ($result as $detail){
        $poza = $detail->poza;
        $mail = $detail->mail;
        $telefon = $detail->telefon;
        $descriere = $detail->despre;
        $serv = $detail->nume_serviciu.' - '.$detail->descriere_serviciu;
        $nume = $detail->nume;
    }
}
?>
            <table width="950">
                <tr>
                    <td width="300" height="300" valign="top">
                        <div style="width: 250px; height: 250px; border: 1px solid grey;margin: 10px;">
                            
                        
                        <?php if(!isset($poza) || $poza==null){
                            echo '<a href="'.  base_url().'welcome/adauga_poza">Adauga poza</a>';
                        }else{
                            echo '<img src="'.  base_url().'poza/'.$poza.'" width="230" style="margin:10px;" />';
                        }?>     </div>
                    </td>
                    <td width="750" valign="top">
                        <table width="650">
                            <tr>
                                <td valign="top" width="150">Nume: </td><td>
                                    <?php if(isset($nume)) echo $nume; ?> 
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">Serviciu: </td><td>
                                    <?php if(isset($serv)) echo $serv; ?> 
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">Adresa de e-mail: </td><td>
                                    <?php if(isset($mail)) echo $mail; ?> 
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">Telefon: </td><td><?php if(isset($telefon)) echo $telefon; ?>  </td>
                            </tr>
                            <tr>
                                <td valign="top">Despre mine: </td><td>
                                    <?php if(isset($descriere)) echo $descriere; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

        </div>
    </div> 
    <?php include_once'templates/footer.php'; ?>