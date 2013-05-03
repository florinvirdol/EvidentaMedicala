<?php include_once'templates/header.php'; ?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >
            <?php 
            foreach($person_details as $x){
                $nume = $x->nume;
                $mail = $x->mail;
                $telefon = $x->telefon;
                $despre = $x->despre;
            }
            ?>
            <center>
                <table bgcolor=#F0EFE2 width="600">
                    <tr>
                        <td colspan="2"><h4>Actualizare informatii personale</h4></td>
                    </tr>
                    <form action="<?php echo base_url(); ?>welcome/edit_account" method="post">
                        <tr>
                            <td>Nume: </td><td>   <input type="text" name="nume" value="<?php if(isset($nume)) echo $nume; ?>"> </td></tr>
                        <tr>
                            <td>Adresă de e-mail: </td><td>  <input type="text" name="mail" value="<?php if(isset($mail)) echo $mail; ?>"></td></tr>
                        <tr>
                            <td>Telefon: </td><td>  <input type="text" name="telefon" value="<?php if(isset($telefon)) echo $telefon; ?>"></td></tr>
                        <tr>
                            <td>Despre mine: </td><td>  
                                <textarea name="despre"><?php if(isset($despre)) echo $despre; ?>
                                </textarea></td></tr>
                        <input type="hidden" name="log" value="1">
                        <tr>
                            <td colspan="2">   <input type="submit" name="login" value="trimite"><br>
                            </td>
                        </tr>
                    </form>
                </table>
                <?php if (isset($msg3)) echo $msg3; ?>
            </center>
        </div>
    </div> 
    <?php include_once'templates/footer.php'; ?>