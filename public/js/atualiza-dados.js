$(document).ready(function() { 
    $('.invalid-feedback').show();
    var phoneMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    phoneOptions = {onKeyPress: function(val, e, field, options) {
        field.mask(phoneMaskBehavior.apply({}, arguments), options);
    }
    };
    $('input[name="telefone"]').mask(phoneMaskBehavior, phoneOptions);
    $('input[name="email"]').focus(); 
    if ($('input.is-invalid')[0]) {
        $('input.is-invalid')[0].focus();
    }
    $('button.apagarLicenca').on('click',function () {
        $(this).parents('form').submit(); 
    });
    $('#addLicenca').on('shown.bs.modal', function (e) {
        setTimeout(function() {
            $('div#addLicenca input#txtModalIndicativo').focus();
        },200);
    });
  });
