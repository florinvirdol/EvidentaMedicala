function validateFormOnSubmit_add(theForm)
{

    try
    {
        var ok = 1;

        var illegalChars = /[A-Za-z0-9_\/\\]/; // allow letters, numbers, and underscores, slash, backslash

        var _radio_value = $('input[name=group1]:radio:checked').attr('value');

        var _selectNr = $('select[name=tip_numar_cautare]');
        var _selectNr_value = _selectNr.attr('value');

        var _selectId = $('select[name=id_structura_emitenta]');
        var _selectId_value = _selectId.attr('value');

        var _inputNr = $('input[name=nr_cautare]');
        var _inputNr_value = _inputNr.attr('value');

        switch (_radio_value)
        {
            case 'numar':
                if (_selectNr_value == 99999)
                {
                    _selectNr.css({'background-color' : 'red'});

                    if (($.trim(_inputNr_value) == "") || !illegalChars.test($.trim(_inputNr_value)) || ($.trim(_inputNr_value) == 0))
                    {
                        ok = 0;

                        _inputNr.css({'background-color' : 'red'});
                    }
                    else
                    {
                        _inputNr.css({'background-color' : 'white'});
                        return false;
                    }
                }
                else
                {
                    _selectNr.css({'background-color' : 'white'});

                    if (!$.trim(_inputNr_value) || !illegalChars.test($.trim(_inputNr_value)) || (_inputNr_value == 0))
                    {
                        ok = 0;

                        _inputNr.css({'background-color' : 'red'});
                    }
                    else
                    {
                        _inputNr.css({'background-color' : 'white'});
                    }
                }
                break;

            case 'structura_emitenta':
                if (_selectId_value == 99999)
                {
                    ok = 0;

                    _selectId.css({'background-color' : 'red'});
                }
                else
                {
                    _selectId.css({'background-color' : 'white'});
                }
                break;
        }

        if (ok)
        {
            return true;
        }
        else
        {
            alert('Informatiile NU au fost introduse corect!\n' +
                'Revizuiti campurile marcate cu rosu!');
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