$(document).ready(function() {
    $('#eventosTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'eventos/jsonGrid',
        language: {
            url: 'public/js/datatables-ptBR.json',
        },    
        columns:[
                {"data":1},
                {"data":2},
                {"data":3},
                {"data":4},
                {"data":0,"className":"text-center"}
        ],  
        columnDefs: [
            {bSortable: false, targets: [4]},
            {  targets: 4,
                render: function (data, type, row, meta) {
                   return ""+
                   "<a title=\"Editar\" href=\""+base_url+"eventos/update/"+data+"\" class=\"mr-2 ml-2\"><i class=\"fa fa-edit\"></i></a>"+
                   "<a title=\"Apagar\" href=\""+base_url+"eventos/delete/"+data+"\" class=\"mr-2 ml-2\"><i class=\"fa fa-trash\"></i></a>";
                }   
            }              
        ],
        bLengthChange : false,
        pageLength: 100,
        initComplete: function(settings, json) {
            $('#eventosTable_wrapper div.row:first div.col-md-6:first').html('<a href="'+base_url+'eventos/insert" class="ml-2" title="Inserir novo registro"><i class="fa fa-plus mr-2"></i> Inserir</a>');
          }                  
    });
});