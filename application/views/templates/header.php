<!DOCTYPE HTML>
<html>

<head>
<title>MAI - Evidenta Medicala</title>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<link rel="shortcut icon" href="/favicon.ico" >


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.css" title="style" />
<!--        <link rel="stylesheet" type="text/css" href="--><?php //echo base_url(); ?><!--css/style.css" title="style" />-->


<!--        <link rel="stylesheet" type="text/css" href="--><?php //echo base_url(); ?><!--css/bootstrap/bootstrap.css" title="style" />-->

<!--        <link type="text/css" href="--><?php //echo base_url(); ?><!--themes/my_theme/jquery.ui.all.css" rel="Stylesheet">-->
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/jquery.ui/base/jquery.ui.all.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/jquery.ui/base/jquery.ui.css">


<!--        <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--themes/jquery.ui/base/jquery.ui.tooltip.css">-->


<!--        <link rel="stylesheet" type="text/css" href="--><?php //echo base_url(); ?><!--css/jquery.qtip.css" />-->


<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery-migrate-1.1.0.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery-ui-1.10.0.js"></script>

<!--        <script type="text/javascript" src="--><?php //echo base_url(); ?><!--js/bootstrap/bootstrap.js"></script>-->



<!--        <link rel="stylesheet" type="text/css" href="--><?php //echo base_url(); ?><!--css/bootstrap/bootstrap.css" title="style" />-->



<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/DT_bootstrap.css" title="style" />


<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap/bootstrap.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.dataTables.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/DT_bootstrap.js"></script>


<!--        <script type="text/javascript" src="--><?php //echo base_url(); ?><!--js/jquery/jquery.qtip.js"></script>-->


<script src="<?php echo base_url(); ?>js/jquery/jquery.ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>js/jquery/jquery.ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>js/jquery/jquery.ui/jquery.ui.position.js"></script>
<script src="<?php echo base_url(); ?>js/jquery/jquery.ui/jquery.ui.tooltip.js"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>js/validations/validate_add_lucrari.js"></script>

<script type="text/javascript">
    function fnDrawAddTooltip_LinkBtn ()
    {
        var $_inputs = $('a, [type="submit"]');

        $_inputs.each(
            function()
            {
                $(this).not(".not_btn").addClass("btn").css('color', '#08C');;
//                        $(this).not(".not_btn").addClass("btn");
            });

        $('.dataTable td[title]').tooltip({
            position: {
                my: "center bottom",
                at: "center top",

                using: function( position, feedback ) {
                    $( this ).css( position );
                    $( "<div>" )
                        .addClass( "arrow" )
                        .addClass( feedback.vertical )
                        .addClass( feedback.horizontal )
                        .appendTo( this );
                }
            }
        });

    }

    $(function()
    {
        $("._datepicker").datepicker(
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


        var icons = {
            header: "ui-icon-circle-arrow-e",
            activeHeader: "ui-icon-circle-arrow-s"
        };
        $( "#accordion" ).accordion({
            icons: icons,
            heightStyle: "content",
            clearStyle: true
        });

        $("#accordion b, #accordion a").each(
            function()
            {
                var $tag = $(this).prop('tagName');

                if ($tag === 'B')
                {
                    var $color_fromId = $(this).attr('id');

                    $(this).css('color', $color_fromId);
                }
                else if ($tag === 'A')
                {
                    $(this).css('color', '#08C');
                }
            });
    });
</script>
<style>
    .ui-tooltip, .arrow:after {
        background: black;
        border: 2px solid white;
    }
    .ui-tooltip {
        padding: 10px 20px;
        color: white;
        border-radius: 20px;
        font: bold 14px "Helvetica Neue", Sans-Serif;
        text-transform: uppercase;
        box-shadow: 0 0 7px black;
    }
    .arrow {
        width: 70px;
        height: 16px;
        overflow: hidden;
        position: absolute;
        left: 50%;
        margin-left: -35px;
        bottom: -36px;
    }
    .arrow.top {
        top: -16px;
        bottom: auto;
    }
    .arrow.left {
        left: 20%;
    }
    .arrow:after {
        content: "";
        position: absolute;
        left: 20px;
        top: -20px;
        width: 25px;
        height: 25px;
        box-shadow: 6px 5px 9px -9px black;
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        tranform: rotate(45deg);
    }
    .arrow.top:after {
        bottom: -20px;
        top: auto;
    }
</style>





<?php
$whereiam = $this->uri->segment('2');

//            if ($whereiam == 'adauga_reteta')
if ($whereiam == 'salveazaReteta')
{
    ?>
<!--                TODO !! download locally-->
    <script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>

    <style>
        .ui-autocomplete {
            max-height: 100px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
        }
            /* IE 6 doesn't support max-height
             * we use height instead, but this forces the menu to always be this tall
             */
        * html .ui-autocomplete {
            height: 100px;
        }
    </style>

    <script type="text/javascript">

        $(document).ready(function()
        {



//            _cnpIfLenght==13=>ajax=>nume_prenume_cod_
            $('#cnp_pacient').keyup(function(event)
            {
                addInputsRules();


                //taste diferite de arrowkeys
                var arrowkeys = [37, 38, 39, 40];
                if ($.inArray(event.keyCode, arrowkeys) == -1)
                {
                    cnpLengthAjax();
                }
            });

            //TODO: lucrari -> retete : controller !!!

            <!--                        source: "--><?//=base_url()?><!--" + "lucrari/getMedicamenteNecompensate"-->

//http://stackoverflow.com/questions/13896828/jquery-ui-autocomplete-not-send-hidden-input-new-value-to-script-url
//http://stackoverflow.com/questions/15200964/how-to-pass-hidden-id-using-json-in-jquery-ui-autocomplete/15223586#15223586
//https://forum.jquery.com/topic/jquery-autocomplete-update-of-multiple-fields
//http://stackoverflow.com/questions/16060920/jquery-ui-autocomplete-how-can-i-set-the-id-into-the-textbox-and-it-will-return
//http://stackoverflow.com/questions/15200964/how-to-pass-hidden-id-using-json-in-jquery-ui-autocomplete
//http://stackoverflow.com/questions/15382719/jquery-ui-autocomplete-how-to-storage-the-items-not-only-the-values
//http://jsfiddle.net/fU8hn/4/



            inputsAutocomplete();


            // adding rules for inputs with class 'comment'
//            ruleRequiredInputSelect();

//            ruleNrInput();
<!---->
//            ruleLitInput();
<!---->
//            ruleNr_LitInput();


            $('#salveazaRetetaForm').on('submit', function(event)
            {
                addInputsRules();

                /*// adding rules for inputs
                ruleRequiredInputSelect();

                ruleNrInput();

                ruleLitInput();

                ruleNr_LitInput();*/
            });

            //TODO: !!! add rules..... independente??? pt fiecare camp?? numeric../ lenght

//            $.validator.messages.required = ' ! ';




//            http://stackoverflow.com/questions/5696222/jquery-validator-check-input-against-a-list-of-accepted-values

            /*jQuery.validator.addMethod("isstate", function(value) {
                var states = ['PA', "CA"] // of course you will need to add more
                var in_array = $.inArray(value.toUpperCase(), states);
                if (in_array == -1) {
                    return false;
                }else{
                    return true;
                }
            }, "Data provided is not a valid sate");*/


/*            //outside!!ready
            function getMedicamenteNomenclatorByDate(CURRENT_DATE)
            {
                .ajax ... fct _controller => json..? array strings!!
            }
            function checkIfMedicamentExists(value)
            {
                //value = $.#id..val??

                //!!!states = getMedicamenteNomenclatorByDate(CURRENT_DATE)
//                var states = ['PA', "CA"] // of course you will need to add more

                var in_array = $.inArray(value.toUpperCase(), states);
                if (in_array == -1) {
                    return false;
                }else{
                    return true;
                }
            }
            jQuery.validator.addMethod("isstate", checkIfMedicamentExists(), "Data provided is not a valid sate");*/


            //????
//            http://stackoverflow.com/questions/14605776/jquery-validator-addmethod-not-working-correctly


            /*$.validator.addMethod("alphaX", function(value, element) {
                return this.optional(element) || /^[a-z0-9\-]+$/i.test(value);
            }, "Username must contain only letters, numbers, or dashes.");*/

            $.validator.addMethod
            (
                "date_rgx",
                function(value, element)
                {
                    return this.optional(element) || /^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$/i.test(value);
//                    return this.optional(element) || /^(19|20)$/i.test(value);
                }
            );

            $.validator.addMethod
            (
                "lit",
                function(value, element)
                {
                    return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
                }
            );

            $.validator.addMethod
            (
                "nr_lit",
                function(value, element)
                {
                    return this.optional(element) || /^[0-9a-zA-Z]+$/i.test(value);
                }
            );

            $("#salveazaRetetaForm").validate(
                {
                    //??rules: ?? nr fisa/registru/reteta/serie reteta??

                    rules:
                    {
                        data_eliberare_reteta:
                        {
                            date_rgx: true
                        },
                        cnp_pacient:
                        {
                            rangelength: [13, 13],
                            number: true
                        }
                    },
                    messages:
                    {
                        date_rgx: "Campul Data Eliberare Rețetă nu e valid [AN-LUNA-ZI]! Apasati iconita din dreapta pt a selecta data!",
                        cnp_pacient: "Campul CNP Pacient trebuie sa fie valid si sa contina exact {1} cifre!"
                    },
                    errorContainer: $('#errorContainer'),
                    errorLabelContainer: $('#errorContainer ul'),
                    wrapper: 'li'
                }
            );

//            $.validator.messages.required = 'Campul  este obligatoriu și trebuie completat';

            jQuery.extend(jQuery.validator.messages, {
                required: "Campul {1} este obligatoriu și trebuie completat!",
                remote: "Please fix this field.",
                email: "Please enter a valid email address.",
                url: "Please enter a valid URL.",
                date: "Please enter a valid date.",
//                date_rgx: "Campul {1} nu e valid [AN-LUNA-ZI]! Apasati iconita din dreapta pt a selecta data!",
                dateISO: "Please enter a valid date (ISO).",
                lit: "Campul {1} trebuie să conțină doar litere!",
                number: "Campul {1} trebuie să conțină doar cifre!",
                nr_lit: "Campul {1} trebuie să conțină doar litere si cifre!",
                digits: "Please enter only digits.",
                creditcard: "Please enter a valid credit card number.",
                equalTo: "Please enter the same value again.",
                accept: "Please enter a value with a valid extension.",
                maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
                minlength: jQuery.validator.format("Please enter at least {0} characters."),
                rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
                range: jQuery.validator.format("Please enter a value between {0} and {1}."),
                max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
                min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
            });
        });

        function cnpLengthAjax()
        {
            var $_cnp_pacient = $("#cnp_pacient");
            var $_cnp_pacient_value = $_cnp_pacient.val();

            if ($.isNumeric($_cnp_pacient_value) && $_cnp_pacient_value.length == 13)
            {
                var $_url = "<?=base_url()?>" + "lucrari/checkIfCNPExists";

                $.ajax(
                    {
                        type: "POST",
                        url: $_url,
                        data:
                        {
                            'cnp_pacient' : $_cnp_pacient_value
                        },
                        dataType: 'json'
                    })
                    .done(function(data)
                    {
                        if(data.exists)
                        {
                            $_cnp_pacient.css({'background-color' : 'white'});

                            $("#hidden_id_pacient").val(data.pacient["id"]);
                            $("#nume_pacient").val(data.pacient["nume"]);
                            $("#prenume_pacient").val(data.pacient["prenume"]);
                            $("#cod_pacient").val(data.pacient["cod_asigurat"]);
                        }
                        else
                        {
                            $_cnp_pacient.css({'background-color' : 'red'});
                            alert('CNP NU exista!');
                    //TODO:: cand nu exista cnp-ul, trebuie adaugat un pacient nou in inputuri,
                    //si apoi inserat in tabela de pacienti, si etichetata reteta ca nu exista cnp-ul!~..
            // => gen: introduceti numele si 0 la cnp si la asigurat!

                            $("#hidden_id_pacient").val("");

                            $("#nume_pacient").val("");
                            $("#prenume_pacient").val("");
                            $("#cod_pacient").val("");

                        }
                    })
                    .fail(function(data){
                        //error
                    });
            }
            else
            {
                $("#hidden_id_pacient").val("");
                $("#nume_pacient").val("");
                $("#prenume_pacient").val("");
                $("#cod_pacient").val("");
            }
        }

        //??
        $.expr[':'].textEquals = function(a, i, m)
        {
            return $(a).text() === m[3];
        };
        //??

        function inputsAutocomplete()
        {
            $("input.autocomplete").autocomplete({
                // path to the get_birds method
                source: "<?=base_url()?>" + "lucrari/getMedicamenteNecompensate" + "/1",
                select: function(event, ui)
                {
                    $(this).css({'background-color' : 'white'});

                    //TODO dynamic id...
                    $("#hidden_id_medicament_nc_1").val(ui.item.id);

                    //TODO:: !!! pt compensate!!
                    // cand selectez ceva pt internationala
                    // sa bage autocomplete si pt comerciala in functie de ce e la internatz

                },
                change: function (ev, ui)
                {
                    var val = $(this).val()
                        .replace("(", "\\(")
                        .replace(")", "\\)");

//                    if (!ui.item)
                    if ($(".ui-autocomplete li:textEquals('" + val + "')").size() === 0)
                    {
                        //
                        //TODO: forteaza sa aleaga din lista
                        //DAR
                        //daca introduce manual ceva din lista, nu ii accepta.. :|
                        $(this).css({'background-color' : 'red'});
                        alert("Alegeti un medicament din lista de sugestii!");
                        $(this).val("");
                    }
                    else
                    {
                        $(this).css({'background-color' : 'white'});
                    }
                }
            });
        }


        function addInputsRules()
        {
            // adding rules for inputs
            ruleRequiredInputSelect();

            ruleNrInput();

            ruleLitInput();

            ruleNr_LitInput();
        }

        function ruleRequiredInputSelect()
        {
            $('input, select').each(function()
            {
                $(this).rules
                (
                    "add",
                    {
                        required: [true, $(this).attr("name")]
                    }
                )
            });
        }

        function ruleNrInput()
        {
            $('input.nr').each(function()
            {
                $(this).rules
                (
                    "add",
                    {
                        number: [true, $(this).attr("name")]
                    }
                )
            });
        }

        function ruleLitInput()
        {
            $('input.lit').each(function()
            {
                $(this).rules
                (
                    "add",
                    {
                        lit: [true, $(this).attr("name")]
                    }
                )
            });
        }

        function ruleNr_LitInput()
        {
            $('input.nr_lit').each(function()
            {
                $(this).rules
                (
                    "add",
                    {
                        nr_lit: [true, $(this).attr("name")]
                    }
                )
            });
        }

        function schimba_tip_retea(value)
        {
            //TODO:!! pacient!!

            switch (value)
            {
                case "0":
                    $("#info_doar_compensata").hide();
                    $("#m_c").hide();

                    $("#m_nc").show();

                    $("#cnp").hide();
                    $("#cod").hide();

                    break;

                case "1":
                    $("#m_nc").hide();

                    $("#info_doar_compensata").show();
                    $("#m_c").show();

                    $("#cnp").show();
                    $("#cod").show();

                    break;

                default:
                    $("#info_doar_compensata").hide();
                    $("#m_c").hide();
                    $("#m_nc").hide();
            }
        }

        function adauga_medicament_compensat_element()
        {
            var contor_med = $("#medicamente_compensate fieldset").length + 1;

            if (contor_med == 8)
            {
                alert("Sunt permise doar 7 medicamente!");
                return false;
            }

            $("#medicamente_compensate").append(
                '<fieldset id="info_medicament_c_' + contor_med + '">' +
                    '<legend>Medicament ' + contor_med + '</legend>' +
                    '<input type="hidden" name="hidden_ids_medicamente_c_[' + contor_med + ']" id="hidden_id_medicament_c_' + contor_med + '">' +
                    /*'<label for="international_medicamente_c_[' + contor_med + ']">Nume International</label>' +
                    '<input type="text" name="international_medicamente_c_[' + contor_med + ']" class="autocomplete lit">' +*/
                    '<label for="medicamente_c_[' + contor_med + ']">Nume International</label>' +
                    '<input type="text" name="medicamente_c_[' + contor_med + ']" class="autocomplete lit">' +
                    '<label for="comercial_medicamente_c_[' + contor_med + ']">Nume Comercial</label>' +
                    '<input type="text" name="comercial_medicamente_c_[' + contor_med + ']" class="lit">' +
                    '<br>' +
                    '<label for="vals_amanunt_medicamente_c_[' + contor_med + ']">Valoare Amanunt</label>' +
                    '<input type="text" name="vals_amanunt_medicamente_c_[' + contor_med + ']" class="nr">' +
                    '<label for="vals_compensat_medicamente_c_[' + contor_med + ']">Valoare Compensat</label>' +
                    '<input type="text" name="vals_compensat_medicamente_c_[' + contor_med + ']" class="nr">' +
                    '<br>' +
                '</fieldset>'
            );

            inputsAutocomplete();

            //TODO:
            //autcomplete  ->   adauga_reteta/getMedicamentNomenclator/ _id___index??_
        }

        function sterge_medicament_element(compensat)
        {
            if (compensat)
            {
                var contor_med = $("#medicamente_compensate fieldset").length;
            }
            else
            {
                var contor_med = $("#medicamente_necompensate fieldset").length;

            }

            if (contor_med == 1)
            {
                alert("Trebuie cel putin un medicament!");
                return false;
            }

            if (compensat)
            {
                $("#info_medicament_c_" + contor_med).remove();
            }
            else
            {
                $("#info_medicament_nc_" + contor_med).remove();
            }
            contor_med--;
        }

        function adauga_medicament_element()
        {
            var contor_med = $("#medicamente_necompensate fieldset").length + 1;

            $("#medicamente_necompensate").append(
                '<fieldset id="info_medicament_nc_' + contor_med + '">' +
                    '<legend>Medicament ' + contor_med + '</legend>' +
                    '<input type="hidden" name="hidden_ids_medicamente_nc_[' + contor_med + ']" id="hidden_id_medicament_nc_' + contor_med + '">' +
                    '<label for="medicamente_nc_[' + contor_med + ']">Nume Comercial</label>' +
                    '<input type="text" name="medicamente_nc_[' + contor_med + ']" class="autocomplete lit">' +
                    '<label for="vals_medicamente_nc_[' + contor_med + ']">Valoare</label>' +
                    '<input type="text" name="vals_medicamente_nc_[' + contor_med + ']" class="nr">' +
                    '<br>' +
                    '</fieldset>'
            );

            inputsAutocomplete();
        }
    </script>
<?php
}
elseif ($whereiam == 'cauta_lucrari')
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
            var $_nr_intern = $("#id_nr_intern");

            var $_url = "<?=base_url()?>" + "lucrari/checkIfExists";

            $_nr_intern.keyup(function()
            {
                var $_nr_intern_value = $_nr_intern.val();

                //ajax request
                $.ajax(
                    {
                        type: "POST",
                        url: $_url,
                        data:
                        {
                            'nr_intern' : $_nr_intern_value
                        },
                        dataType: 'json'
                    })
                    .done(function(data)
                    {
                        if(data.result)
                        {
                            $_nr_intern.css({'background-color' : 'red'});
                            alert('Lucrare exista!');
                        }
                        else
                        {
                            $_nr_intern.css({'background-color' : 'white'});
                            console.log('Lucrare NU exista!');
                        }
                    })
                    .fail(function(data){
                        //error
                    });
            });


            var $_spreRepartizare = $("#id_spre_repartizare");
            var $_RepartizatLa = $("#id_lucrator_repartizat");

            $_spreRepartizare.click(function()
            {
//                            $_RepartizatLa.prop("disabled", $_spreRepartizare.prop('checked'));

                var $_inputsNerepartizate = $('tbody.nerepartizate select, tbody.nerepartizate input, select.nerepartizate, tbody.nerepartizate img');

                if($_spreRepartizare.is(':checked'))
                {
                    $_inputsNerepartizate.each(
                        function()
                        {
                            $(this).css({'background-color' : '#D4D0C8'});
                            $(this).attr("disabled", true);

                            if ($(this).is("select"))
                            {
                                $(this).val(99999);
                            }
                            /*//TODO ??  NULL ?
                             else
                             {
                             var x = null;
                             //                                            $(this).val(NULL);
                             $(this).val(x);
                             }*/

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
                    $_inputsNerepartizate.each(
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
        });
    </script>

<?php
}
elseif ($whereiam == 'detaliere_lucrare')
{
?>
    <script type="text/javascript">
        function validateCommentLength()
        {
            var ok = ($("#comment").val().length > 7);

            if (!ok)
            {
                $("#comment_error").show().slideDown("slow");
            }
            return ok;
        }
    </script>
<?php
}
?>

</head>

<body>
<div id="main">
    <div id="header">

        <div class="header_container">
            <div id="sigla"><img src="<?php echo base_url(); ?>images/Untitled-1.png" alt="Sigla Institutie"  height="155"></div>
            <div id="logo">
                <!-- class="logo_colour", allows you to change the colour of the text -->
                <h2>Ministerul Afacerilor Interne</h2>
                <h1><a class="not_btn" ><span class="logo_colour">
                                    Evidență Medicală
                </h1>
            </div>
        </div>

    </div>
    <div style="position: fixed;margin-left: 0px;" >
        <!--               <a class="not_btn" href="--><?php //echo base_url(); ?><!--sugestii">-->
        <a class="not_btn" href="<?php echo base_url(); ?>notifications/notify_suggestion">
            <img alt="" src="<?php echo base_url();?>images/sugestii.png" width="30" /></a>
    </div>
    <!-- final header -->
    <div id="menubar">
        <ul id="menu">
            <?php
            if (isset($_SESSION['user']))
            {
                ?>
                <?php
                if ($_SESSION['user_role'] == '0')
                {
                    ?>
                    <li><a class="not_btn" href="<?php echo base_url(); ?>lucrari/salveazaReteta">Salvează Rețete</a></li>
                    <li><a class="not_btn" href="<?php echo base_url(); ?>lucrari/lucrari_personale">Cautare/Filtrare Retete propri ?</a></li>
                <?php
                }
                if ($_SESSION['user_role'] == '1')
                {
                    ?>
                    <li><a class="not_btn" href="<?php echo base_url(); ?>lucrari/cauta_lucrari">Căutare Doctori/Retete</a></li>
                    <li><a class="not_btn" href="<?php echo base_url(); ?>lucrari/lucrari_serviciu">Căutare / Filtrare Doctori/Retete</a></li>
                <?php
                }
            }
            ?>
        </ul>
                <span style="color:white;float:right;padding: 20px">

                    <?php
                    if (isset($_SESSION['user']))
                    {
                    ?>
                    <a class="not_btn" href="<?php echo base_url(); ?>welcome/my_account">Contul meu </a> |
                            <a class="not_btn" style="text-decoration: none" href="<?php echo base_url(); ?>logout">Logout</a> <?php echo $_SESSION['user']; ?></span>
        <?php
        }
        else
        {
            echo '<a class="not_btn" style="text-decoration: none" href="' . base_url() . 'login">Autentificare</a></span>';
        }
        ?>
        <div style="clear: both"></div>
        <?php if(isset($_SESSION['lucrare_baza'])){ ?>
            <h6>Lucrare selectata pentru conexare:
                <a href="<?php echo base_url()?>lucrari/detaliere_lucrare/<?php echo $_SESSION['id_lucrare_baza'];?>"><?php echo $_SESSION['lucrare_baza'];?></a>
                | <a href="<?php echo base_url()?>lucrari/remove_selected">Deselectare</a>
            </h6>
        <?php }?>
    </div>