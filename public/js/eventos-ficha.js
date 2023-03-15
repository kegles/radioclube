$(document).ready(function() {
    $('input[name="data"]').mask('00/00/0000');    
    $('select[name="ativo"]').focus(); 
    if ($('input.is-invalid')[0]) {
        $('input.is-invalid')[0].focus();
    }

});