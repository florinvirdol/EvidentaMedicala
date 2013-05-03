function validateFormOnSubmit_add_lucrari(theForm)
{
    try
    {
        var ok1 = new Array(50);
        var k = 0;

        var illegalChars = /[A-Za-z0-9_-]/; // allow letters, numbers, and underscores, - (for Date)

        var $_inputProvenienta = $('#provenienta');
//        var _inputProvenienta_value = $_inputProvenienta.attr('value');
        var _inputProvenienta_value = $_inputProvenienta.val();

        var $_spreRepartizare = $("#id_spre_repartizare");
        var $_RepartizatLa = $("#id_lucrator_repartizat");
//        var _RepartizatLa_value = $_RepartizatLa.attr('value');
        var _RepartizatLa_value = $_RepartizatLa.val();


        var $_inputs = $('#form_add_lucrari tbody.mandatory textarea, #form_add_lucrari tbody.mandatory select, #form_add_lucrari tbody.mandatory input');

        $_inputs.each(
            function()
            {
                //TODO: sa scot checkbox-urile care-s optionale..

//                var _field_value = $(this).attr('value');
                var _field_value = $(this).val();

//                console.log(_field_value);

                if (!$.trim(_field_value) || (_field_value == 99999) || !illegalChars.test($.trim(_field_value)))
                {
                    //fortez in fct de provenienta!
//                    if ((_inputProvenienta_value == "Serviciu intern") && ($(this).attr('name') == "nr_dgcti" || $(this).attr('name') == "data_dgcti" || $(this).attr('name') == "nr_emitere" || $(this).attr('name') == "data_emitere"))
                    if ((_inputProvenienta_value == "Serviciu intern")
                        && ($(this).attr('name') == "nr_dgcti" || $(this).attr('name') == "data_dgcti" || $(this).attr('name') == "nr_emitere" || $(this).attr('name') == "data_emitere")
                        /*&& (!$_spreRepartizare.is(':checked'))*/)
                    {
                        //serv intern

                        $(this).css({'background-color' : 'white'});

                        ok1[k++] = 1;
                    }
                    else
                    {
                        $(this).css({'background-color' : 'red'});

                        ok1[k++] = 0;
                    }
                }
                else
                {
                    ok1[k++] = 1;

                    $(this).css({'background-color' : 'white'});
                }
            });

        var ok2 = 0;

        var $_inputStrNoua = $('#structura_emitenta');
//        var _inputStrNoua_value = $_inputStrNoua.attr('value');
        var _inputStrNoua_value = $_inputStrNoua.val();

        var $_inputStrEmitenta = $('#id_structura_emitenta');
//        var _inputStrEmitenta_value = $_inputStrEmitenta.attr('value');
        var _inputStrEmitenta_value = $_inputStrEmitenta.val();

        if (_inputStrEmitenta_value != 99999)
        {
            //strEmit selected

            ok2 = 1;

            $_inputStrNoua.css({'background-color' : 'white'});
            $_inputStrNoua.val('');

            //fortez sa ii permita null la "str noua"
            ok1[8] = 1;
        }
        else
        {
            //strEmit NOT selected:

            if ($.trim(_inputStrNoua_value) != "" && illegalChars.test($.trim(_inputStrNoua_value)))
            {
                //input completed

                ok2 = 1;

                $_inputStrEmitenta.css({'background-color' : 'white'});

                //fortez sa ii permita null la "str emitenta"
                ok1[7] = 1;
            }
        }

        //daca e spre repartizare => fara repartizat la

        //TODO: nu-i prea ok ca il hardcodez!!
        //TODO SOL?? if is cheked sa nu il bage la verificare ?
        if($_spreRepartizare.is(':checked'))
        {
            //TODO: nu-i prea ok ca il hardcodez!!
            //NU se poate modifica in functie de cati colaboratori/chckbxs sunt

            //TODO: URGENT! se poate modifica!!
//            ok1[23] = ok1[42] = ok1[43] = 1;
            ok1[23] = ok1[44] = ok1[45] = 1;
            //TODO: nu-mi place ca fac artificiu dásta!!
            $('#id_rezolutionar_intern').css({'background-color' : '#D4D0C8'});
            $('#id_data_rezolutionarii').css({'background-color' : '#D4D0C8'});

        }

        if(_RepartizatLa_value != 99999)
        {
            ok1[22] = 1;
        }

        var ok_all = 1, i;

        for (i = 0; i < k; i++)
        {
            if (ok1[i] == 0)
            {
                ok_all = 0;
            }
            console.log("Camp nr. " + i + " = " + ok1[i]);
        }

        if (ok_all && ok2)
        {
            return true;
        }
        else
        {
            alert('Informatiile NU au fost introduse corect!\n Revizuiti campurile marcate cu rosu!');
            return false;
        }
    }
    catch (error)
    {
        console.log(error.message);

        return false;
    }
    return false;
}

//TODO: rename file: add_repartizare
function validateFormOnSubmit_repartizareLucrari_addVers_addOptic(theForm)
{
    try
    {
        var ok1 = new Array(50);
        var k = 0;

        var illegalChars = /[A-Za-z0-9_-]/; // allow letters, numbers, and underscores, - (for Date)

        var formID = theForm.getAttribute('id');

        var $_inputs = $('#' + formID + ' tbody.mandatory select, #' + formID + ' tbody.mandatory textarea, #' + formID + ' tbody.mandatory input');

        $_inputs.each(
            function()
            {
                //TODO: sa scot checkbox-urile care-s optionale..

                //TODO!!!!!
//                var _field_value = $(this).attr('value');
                var _field_value = $(this).val();

                if (!$.trim(_field_value) || (_field_value == 99999) || !illegalChars.test($.trim(_field_value)))
                {
                    console.log(_field_value);

                    ok1[k++] = 0;

                    $(this).css({'background-color' : 'red'});
                }
                else
                {

                    console.log(_field_value);


                    ok1[k++] = 1;

                    $(this).css({'background-color' : 'white'});
                }
            });

        var ok_all = 1, i;

        for (i = 0; i < k; i++)
        {
            if (ok1[i] == 0)
            {
                ok_all = 0;
            }
            console.log("Camp nr. " + i + " = " + ok1[i]);
        }

        if (ok_all)
        {
            return true;
        }
        else
        {
            alert('Informatiile NU au fost introduse corect!\n Revizuiti campurile marcate cu rosu!');
            return false;
        }
    }
    catch (error)
    {
        console.log(error.message);

        return false;
    }
    return false;
}