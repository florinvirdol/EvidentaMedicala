<?php include_once'templates/header.php'; ?>
<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >

            <center><table>
                    <tr>
                        <td colspan="2"><h4>Solicitare cont</h4></td>
                    </tr>
                    <form action="<?php echo base_url(); ?>welcome/signup" method="post">
                        <tr>
                            <td>Adresa de e-mail (intranet): </td><td>   <input type="text" name="email"></input> </td></tr>     

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