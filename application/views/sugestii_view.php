<?php include_once'templates/header.php'; ?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1">
            <center>
<!--                TODO: proba cu library-->
<!--                <form id="form_add_lucrari" method="POST" action="--><?php //echo base_url(); ?><!--sugestii"-->
                <form id="form_add_lucrari" method="POST" action="<?php echo base_url(); ?>notifications/notify_suggestion"
                      onsubmit="return validateFormOnSubmit_add_lucrari(this)">
                    <?php if(isset($eroare)) echo $eroare;?>
                    <table width="900">
                        <tbody class="mandatory">
                            <tr>
                                <td>
                                    <p>
                                        Pentru imbunatatirea aplicatiei de evidenta a lucrarilor va puteti exprima sugestiile / nemultumiri referitoare DOAR la aplicatie in formularul urmator.
                                    </p>
                                </td>
                            </tr>
                            <!--<tr>
                                <td>Autor:
                                    
                                    <input type="text" name="autor"/>
                                </td>
                            </tr>-->
                            <tr>
                                <td>Sugestie
                                    <br/>
<!--                                    <textarea name="sugestie" cols="85"></textarea>-->
                                    <textarea name="sugestie" style="width: 100%;" ></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="trimite" value="Trimite"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </center>
        </div>
    </div> 
    <?php include_once'templates/footer.php'; ?>