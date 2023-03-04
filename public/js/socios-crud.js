$(document).ready(function() {
    $('#sociosTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'socios/jsonGrid',
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
                   "<a title=\"Editar\" href=\"socios/edit/"+data+"\" class=\"mr-2 ml-2\"><i class=\"fa fa-edit\"></i></a>"+
                   "<a title=\"Apagar\" href=\"socios/delete/"+data+"\" class=\"mr-2 ml-2\"><i class=\"fa fa-trash\"></i></a>";
                }   
            },
            {  targets: 2,
                render: function (data, type, row, meta) {
                   return "<a href=\"mailto:"+data+"\">"+data+"</a>";
                }   
            },               
        ]          
    });
});
function sociosUpdate() {
    console.log($(this).parents('tr'));
}
function sociosDelete() {

}