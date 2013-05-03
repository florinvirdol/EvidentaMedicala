  
        </div>
    <div id="content_footer"></div>
    <div id="footer" style="font-size: 80%">
        &copy; D.G.C.T.I - 2013
    </div>
  </div>

        <script type="text/javascript">
            $(function()
            {
                var $_inputs = $('a, [type="submit"]');

                $_inputs.each(
                    function()
                    {
                        $(this).not(".not_btn").addClass("btn").css('color', '#08C');;
//                        $(this).not(".not_btn").addClass("btn");
                    });
            });
        </script>

            <?php
                $whereiam = $this->uri->segment('2');
                if ($whereiam == 'edit_lucrare')
                {
            ?>
                <script>
                    //read-only!
                    $(function()
                    {
                        try
                        {
                            var $_inputs = $('#form_edit_lucrari tbody.mandatory textarea, #form_edit_lucrari tbody.mandatory select, #form_edit_lucrari tbody.mandatory input, #form_edit_lucrari tbody.mandatory img');

                            $_inputs.each(
                                    function()
                                    {
                                        $(this).attr('disabled', 'disabled');

                                        if ($(this).attr('class') == "ui-datepicker-trigger")
                                        {
                                            $(this).css({opacity:'0.5',cursor:'default'}).unbind('click');
                                        }
                                    });
                        }
                        catch (error)
                        {
                            console.log(error.message);

                            return false;
                        }
                    });
                </script>
        <?php
            }
        elseif ($whereiam == 'detaliere_lucrare')
            {
        ?>
<!--                <script>-->
                <script type="text/javascript">

                    $(function()
                    {
//                        var $_conexare_existenta = document.cookie.indexOf("conexare_exitenta");
//                        console.log($_conexare_existenta);
                        var $_conexare_existenta = <?=($this->uri->segment('4') == "cnx" ? 1 : 0)?>;


                        if ($_conexare_existenta)
//                        if ($_conexare_existenta == 1)
                        {
                            alert("Conexare existenta!");
                        }

//                        $_COOKIE['conexare_exitenta'] = null;
//                        document.cookie = "conexare_exitenta=" + null;


                        $("#comment_error").hide();

                        $("#add_comments").click(function()
                        {
                            $("#add_comments").hide();
                            $("#send_comments").show().slideDown("slow");
//                            $("#comment_error").show().slideDown("slow");
                        });

                        $("#send_comments").submit(function()
                        {
                            $("#send_comments").hide();
                            $("#add_comments").show();
                        });
                    });
                </script>
        <?php
            }
        ?>
 
</body>
</html>