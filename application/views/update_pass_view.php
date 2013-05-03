<?php include_once'templates/header.php'; ?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >
            <center>
                <table bgcolor=#F0EFE2>
                    <tr>
                        <td colspan="2"><h4>Schimbare parola</h4></td>
                    </tr>
                    <form action="<?php echo base_url(); ?>welcome/update_pass" method="post">
                        <tr>
                            <td>Vechea parola: </td><td>   <input type="password" name="old_pass"></input> </td></tr>
                        <tr>
                            <td>Parola nouă: </td><td>  <input type="password" name="new_pass"></input></td></tr>
                        <tr>
                            <td>Confirmare parola nouă: </td><td>  <input type="password" name="new_pass2"></input></td></tr>
                        <input type="hidden" name="log" value="1">

                        <tr>
                            <td colspan="2">   <input type="submit" name="login" value="trimite"></input><br>
                            </td>
                        </tr>
                    </form>
                </table>
                <?php if (isset($msg3)) echo $msg3; ?>
            </center>
        </div>
    </div> 
    <?php include_once'templates/footer.php'; ?>