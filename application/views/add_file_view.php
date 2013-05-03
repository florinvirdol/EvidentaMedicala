<?php include_once'templates/header.php'; ?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1">
            <center>
<!--                <form id="form_add_lucrari" method="POST" action="--><?php //echo base_url(); ?><!--lucrari/file_add"-->
                <form id="form_add_lucrari" method="POST" action="<?php echo base_url(); ?>lucrari/file_add/<?=$id_vers . "/" . $id_lucrare?>"
                      onsubmit="return validateFormOnSubmit_add_lucrari(this)" enctype="multipart/form-data">
                    <input type="hidden" name="id_vers" value="<?php echo $id_vers;?>"/>
                    <table width="900" bgcolor=#F0EFE2>
                        <tbody class="mandatory">
                        <tr>
                            <td align="center">
                                <h4>
                                    Atasare fisier
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td>Fisier:
                                <input type="file" name="fileToBeSigned" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="trimite" value="Adaugare fisier"/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </center>
        </div>
    </div> 
    <?php include_once'templates/footer.php'; ?>