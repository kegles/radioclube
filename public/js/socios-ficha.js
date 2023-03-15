$(document).ready(function() {
    $('.invalid-feedback').show();
    var phoneMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    phoneOptions = {onKeyPress: function(val, e, field, options) {
        field.mask(phoneMaskBehavior.apply({}, arguments), options);
    }};
    $('input[name="dataNascimento"]').mask('00/00/0000');
    $('input[name="cpf"]').mask('000.000.000-00');
    $('input[name="telefone"]').mask(phoneMaskBehavior, phoneOptions);
    $('input[name="cpf"]').focus(); 
    if ($('input.is-invalid')[0]) {
        $('input.is-invalid')[0].focus();
    }

});