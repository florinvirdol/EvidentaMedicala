<?php include_once'templates/header.php'; ?>
<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >

            <center><table width="600">
                    <tr>
                        <td colspan="2"><h4>Solicitare cont</h4></td>
                    </tr>
                    <form action="<?php echo base_url(); ?>welcome/add_user" method="post">
                        <input type="hidden" name="hash_mail" value="<?php echo $hash_mail; ?>" />
                        <tr>
                            <td>Nume complet: </td><td>   <input type="text" name="name"></input> </td></tr>     
                        <tr>
                            <td>Parola : </td><td>  <input type="password" name="new_pass"></input></td></tr>
                        <tr>
                            <td>Confirmare parola : </td><td>  <input type="password" name="new_pass2"></input></td></tr>
                        <tr>
                            <td>Serviciu: </td>
                            <td> <select name="id_serv">

                                    <?php foreach ($servicii->result() as $rows) { ?>
                                        <option value="<?php echo $rows->id; ?>" ><?php echo $rows->name; ?></option>";
                                    <?php }
                                    ?>            </select></td>
                        </tr>
                        <tr>
                            <td colspan="2"> <input type="submit" name="Send" value="Send"></input>
                            </td>
                        </tr> </form>
                </table>
                <?php if (isset($msg3)) echo $msg3; ?>
        </div>
        </center>
    </div> 
    <?php include_once'templates/footer.php'; ?>