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

$('a.licencas-del').on('click',function() {
    $(this).parent().parent().remove();
});

$('a.licencas-add').on('click',function() {
    var indicativo = $('input[name="_LICENCAS[0][indicativo]"]').val();
    var tipo = $('select[name="_LICENCAS[0][tipo]"]').val();
    var index = Number($('div[class*="licenca-row"]').last().attr('data-index'))+1;
    var newRow = $('div.licenca-new').clone(false);
    $(newRow).attr('data-index',index);
    $(newRow).removeClass('licenca-new').addClass('licenca-row');
    $(newRow).find('input[name="_LICENCAS[0][indicativo]').attr('name','_LICENCAS['+index+'][indicativo]').attr('value',indicativo);
    $(newRow).find('select[name="_LICENCAS[0][tipo]').attr('name','_LICENCAS['+index+'][tipo]');
    $(newRow).find('select[name="_LICENCAS['+index+'][tipo]').find('option').removeAttr('selected');
    $(newRow).find('select[name="_LICENCAS['+index+'][tipo]').find('option[value="'+tipo+'"]').attr('selected',true);
    $(newRow).find('.btn-primary').removeClass('btn-primary').addClass('btn-danger');
    $(newRow).find('.fa-plus').removeClass('fa-plus').addClass('fa-trash');
    $(newRow).find('.licencas-add').removeClass('licencas-add').addClass('licencas-del');
    $(newRow).find('a.licencas-del').on('click',function() {
        $(this).parent().parent().remove();
    });
    $('input[name="_LICENCAS[0][indicativo]').val('');
    $('select[name="_LICENCAS[0][tipo]').val('CA');
    $(newRow).insertBefore('.licenca-new');
    $('input[name="_LICENCAS[0][indicativo]').focus();
});