<?php include_once'templates/header.php'; ?>
<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >

            <center><table>
                    <tr>
                        <td colspan="2"><h4>Autentificare</h4></td>
                    </tr>
                    <form action="<?php echo base_url(); ?>login" method="post">
                        <tr>
                            <td>Utilizator: </td><td>   <input type="text" name="User"> </td></tr>
                        <tr>
                            <td>Parola: </td><td>  <input type="password" name="Password"></td>
                        </tr>
                        <input type="hidden" name="log" value="1">

                        <tr>
                            <td colspan="2">   <input type="submit" name="login" value="login"></input><br>
                            </td>
                        </tr>
                    </form>
                 
                </table>
                <?php if (isset($msg3)) echo $msg3; ?>
        </div>
        </center>
    </div> 
    <?php include_once'templates/footer.php'; ?>