<!DOCTYPE HTML>
<html>

    <head>
        <title>S6</title>

        <meta http-equiv="content-type" content="text/html;charset=utf-8" />

        <link rel="shortcut icon" href="/favicon.ico" >

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css" title="style" />

<!--        <link rel="stylesheet" type="text/css" href="--><?php //echo base_url(); ?><!--css/bootstrap/bootstrap.css" title="style" />-->

        <link type="text/css" href="<?php echo base_url(); ?>themes/my_theme/jquery.ui.all.css" rel="Stylesheet">

        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery-migrate-1.1.0.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery-ui-1.10.0.js"></script>

<!--        <script type="text/javascript" src="--><?php //echo base_url(); ?><!--js/bootstrap/bootstrap.js"></script>-->


        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.css" title="style" />

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/DT_bootstrap.css" title="style" />

        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap/bootstrap.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.dataTables.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/DT_bootstrap.js"></script>


        <script type="text/javascript" src="<?php echo base_url(); ?>js/validations/validate_add_lucrari.js"></script>


        <?php
            $whereiam = $this->uri->segment('2');
            if ($whereiam == 'cauta_lucrari')
            {
        ?>
                <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>js/validations/validate_cautare.js"></script>
                <script type="text/javascript">
                    function changedRadioBtn(first_or_second)
                    {
                        var $_strEmitenta = $('select[name=id_structura_emitenta]');
                        var $_tipNr = $('select[name=tip_numar_cautare]');
                        var $_Nr = $('input[name=nr_cautare]');

                        if (first_or_second == 1)
                        {
                            $_strEmitenta.val(99999);
                            $_strEmitenta.css({'background-color' : 'white'});
                        }
                        else if (first_or_second == 2)
                        {
                            $_tipNr.val(99999);
                            $_tipNr.css({'background-color' : 'white'});

                            $_Nr.val('');
                            $_Nr.css({'background-color' : 'white'});
                        }
                    }
                </script>
        <?php
            }
            elseif ($whereiam == 'add_lucrari')
            {
        ?>
                <script type="text/javascript" src="<?php echo base_url(); ?>js/validations/validate_add_lucrari.js"></script>
                <script type="text/javascript">
                    $(function()
                    {
                        var $_spreRepartizare = $("#id_spre_repartizare");
                        var $_RepartizatLa = $("#id_lucrator_repartizat");

                        $_spreRepartizare.click(function()
                        {
//                            $_RepartizatLa.prop("disabled", $_spreRepartizare.prop('checked'));

                            var $_inputsNerepartizate = $('tbody.nerepartizate select, tbody.nerepartizate input, select.nerepartizat, tbody.nerepartizate img');

                            if($_spreRepartizare.is(':checked'))
                            {
                                $_inputsNerepartizat.each(
                                    function()
                                    {
                                        $(this).css({'background-color' : '#D4D0C8'});
                                        $(this).attr("disabled", true);

                                        if ($(this).is("select"))
                                        {
                                            $(this).val(99999);
                                        }
                                        //TODO ??  NULL ?
                                        else
                                        {
                                            var x = null;
//                                            $(this).val(NULL);
                                            $(this).val(x);
                                        }

                                        if ($(this).attr('class') == "ui-datepicker-trigger")
                                        {
                                            //TODO!! unbind / bind???

//                                            $(this).css({opacity:'0.5',cursor:'default'}).unbind('click');
//                                            $(this).css({opacity:'0.5'}).unbind('click');
                                            $(this).css({opacity:'0.5'});
                                        }
                                    });
                            }
                            else
                            {
                                $_inputsNerepartizat.each(
                                    function()
                                    {
                                        $(this).css({'background-color' : 'white'});
                                        $(this).attr("disabled", false);

                                        if ($(this).attr('class') == "ui-datepicker-trigger")
                                        {
//                                            $(this).css({opacity:'1',cursor:'default'}).bind('click');
//                                            $(this).css({opacity:'1'}).bind('click');
                                            $(this).css({opacity:'1'});
                                        }
                                    });
                            }
                        });


                        /*
                         //TODO: - datepicker's refactoring:

                         var $_inputsdx = $(".datepickerxxx");

                         $_inputsdx.each(
                             function()
                             {
                                 alert("dd");
                                 *//*$(this).attr('disabled', 'disabled');

                                if ($(this).attr('class') == "ui-datepicker-trigger")
                                {
                                    $(this).css({opacity:'0.5',cursor:'default'}).unbind('click');
                                }*//*

                                $(this).attr("id", "dp_id_" + index++);

                            });*/

                        $( "#datepicker" ).datepicker(
                                {

                                    dateFormat: 'yy-mm-dd',
                                    dayNames: ['Duminică', 'Luni', 'Marți', 'Miercuri', 'Joi', 'Vineri', 'Sâmbătă'],
                                    dayNamesMin: ['Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sâ'],
                                    firstDay: 1,
                                    showOn: 'button',
                                    buttonImageOnly: true,
                                    buttonImage: '<?php echo base_url(); ?>images/calendar_1.jpg',
                                    monthNames: ['Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'],
                                    showOtherMonth: true,
                                    showWeek: true ,
                                    weekHeader: 'S',debug:true
                                });
                        $( "#datepicker5" ).datepicker(
                                {

                                    dateFormat: 'yy-mm-dd',
                                    dayNames: ['Duminică', 'Luni', 'Marți', 'Miercuri', 'Joi', 'Vineri', 'Sâmbătă'],
                                    dayNamesMin: ['Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sâ'],
                                    firstDay: 1,
                                    showOn: 'button',
                                    buttonImageOnly: true,
                                    buttonImage: '<?php echo base_url(); ?>images/calendar_1.jpg',
                                    monthNames: ['Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'],
                                    showOtherMonth: true,
                                    showWeek: true ,
                                    weekHeader: 'S',debug:true
                                });
                        $( "#datepicker4" ).datepicker(
                                {

                                    dateFormat: 'yy-mm-dd',
                                    dayNames: ['Duminică', 'Luni', 'Marți', 'Miercuri', 'Joi', 'Vineri', 'Sâmbătă'],
                                    dayNamesMin: ['Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sâ'],
                                    firstDay: 1,
                                    showOn: 'button',
                                    buttonImageOnly: true,
                                    buttonImage: '<?php echo base_url(); ?>images/calendar_1.jpg',
                                    monthNames: ['Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'],
                                    showOtherMonth: true,
                                    showWeek: true ,
                                    weekHeader: 'S',debug:true
                                });
                        $( "#datepicker3" ).datepicker(
                                {

                                    dateFormat: 'yy-mm-dd',
                                    dayNames: ['Duminică', 'Luni', 'Marți', 'Miercuri', 'Joi', 'Vineri', 'Sâmbătă'],
                                    dayNamesMin: ['Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sâ'],
                                    firstDay: 1,
                                    showOn: 'button',
                                    buttonImageOnly: true,
                                    buttonImage: '<?php echo base_url(); ?>images/calendar_1.jpg',
                                    monthNames: ['Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'],
                                    showOtherMonth: true,
                                    showWeek: true ,
                                    weekHeader: 'S',debug:true
                                });
                        $( "#datepicker2" ).datepicker(
                                {

                                    dateFormat: 'yy-mm-dd',
                                    dayNames: ['Duminică', 'Luni', 'Marți', 'Miercuri', 'Joi', 'Vineri', 'Sâmbătă'],
                                    dayNamesMin: ['Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sâ'],
                                    firstDay: 1,
                                    showOn: 'button',
                                    buttonImageOnly: true,
                                    buttonImage: '<?php echo base_url(); ?>images/calendar_1.jpg',
                                    monthNames: ['Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'],
                                    showOtherMonth: true,
                                    showWeek: true ,
                                    weekHeader: 'S',debug:true
                                });
                        $( "#datepicker1" ).datepicker(
                                {

                                    dateFormat: 'yy-mm-dd',
                                    dayNames: ['Duminică', 'Luni', 'Marți', 'Miercuri', 'Joi', 'Vineri', 'Sâmbătă'],
                                    dayNamesMin: ['Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sâ'],
                                    firstDay: 1,
                                    showOn: 'button',
                                    buttonImageOnly: true,
                                    buttonImage: '<?php echo base_url(); ?>images/calendar_1.jpg',
                                    monthNames: ['Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'],
                                    showOtherMonth: true,
                                    showWeek: true ,
                                    weekHeader: 'S',debug:true
                                });
                    });
                </script>

        <?php
            }
            elseif ($whereiam == 'lucrari_serviciu')
            {
        ?>

<!--            <link rel="stylesheet" type="text/css" href="--><?php //echo base_url(); ?><!--css/datatables/demo_page.css" title="style" />-->
<!--            <link rel="stylesheet" type="text/css" href="--><?php //echo base_url(); ?><!--css/datatables/demo_table.css" title="style" />-->
        <?php
            }
            elseif ($whereiam == 'detaliere_lucrare')
            {
                //TODO!!  in header: js: pt toate datepicker-urile sa fac automat asta:

        ?>
<!--                ??-->
            <script type="text/javascript" src="<?php echo base_url(); ?>js/validations/validate_add_lucrari.js"></script>
               <script type="text/javascript">
                   $(function()
                   {
                       $("#id_datepicker_termen").datepicker(
                       {
                           dateFormat: 'yy-mm-dd',
                           dayNames: ['Duminică', 'Luni', 'Marți', 'Miercuri', 'Joi', 'Vineri', 'Sâmbătă'],
                           dayNamesMin: ['Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sâ'],
                           firstDay: 1,
                           showOn: 'button',
                           buttonImageOnly: true,
                           buttonImage: '<?php echo base_url(); ?>images/calendar_1.jpg',
                           monthNames: ['Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'],
                           showOtherMonth: true,
                           showWeek: true ,
                           weekHeader: 'S',debug:true
                       });
                   });
               </script>
        <?php
            }
        ?>


<!--        <link type="text/css" href="--><?php //echo base_url(); ?><!--themes/my_theme/jquery.ui.all.css" rel="Stylesheet">-->
    </head>

    <body>
        <div id="main">
            <div id="header">

                <div class="header_container">
                    <div id="sigla"><img src="<?php echo base_url(); ?>images/Untitled-1.png" alt="Sigla Institutie"  height="155"></div>
                    <div id="logo">
                        <!-- class="logo_colour", allows you to change the colour of the text -->
                        <h2>D.G.C.T.I.</h2>
                        <h1><a ><span class="logo_colour">
                                    Secretariat - S6 <i>beta</i>
                                </span></a><br>
                                Documente neclasificate
                        </h1>
                    </div>
                </div>

            </div>
             <div style="position: fixed;margin-left: 0px;" >
               <a href="<?php echo base_url(); ?>sugestii">
                   <img alt="" src="<?php echo base_url();?>images/sugestii.png" width="30" /></a>
            </div>
            <!-- final header -->
            <div id="menubar">
                <ul id="menu">
                    <?php
                        if (isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == 'autentificat')
                        {
                    ?>
                        <li><a href="<?php echo base_url(); ?>admin/nomenclatoare">Nomenclatoare</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/acces">Management acces</a></li> 
                        <li><a href="<?php echo base_url(); ?>admin/users">Management utilizatori</a></li> 
                     <?php   }
                    ?>
                </ul>
                <span style="color:white;float:right;padding: 20px">

                    <?php
                        if (isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == 'autentificat')
                        {
                    ?>
                    <a style="text-decoration: none" href="<?php echo base_url(); ?>logout">Logout</a></span>
                    <?php
                        }
                        else
                        {
                            echo '<a style="text-decoration: none" href="' . base_url() . 'login">Autentificare</a></span>';
                        }
                    ?>
                <div style="clear: both"></div>       
            </div>