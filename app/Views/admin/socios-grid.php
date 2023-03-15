<?
    //retorna os toasters, pois pode ter vindo da altera-senha uma mensagem
    if (is_array(session()->getFlashdata('toastr'))) {
        $footerdata['toastr'][] = session()->getFlashdata('toastr');
    }
?>

<?= view('elements/header.php'); ?>

<div class="wrapper">
    <!-- sidebar -->
    <?= view('elements/sidebar.php'); ?>
    <!-- content -->
</div>


<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header mr-3 ml-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= _('Sócios'); ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mr-3 ml-3">
        <div class="row">
            <div class="col-12">
                <table id="sociosTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center"><?=_('CPF');?></th>
                            <th><?=_('Nome');?></th>
                            <th><?=_('E-mail');?></th>
                            <th class="text-center"><?=_('Telefone');?></th>
                            <th></th>
                        </tr>
                    </thead>            
                </table>
            </div>
        </div>
    </section>

</div>

<? $footerdata['js'][] = base_url('vendor/almasaeed2010/adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>
<? $footerdata['js'][] = base_url('vendor/almasaeed2010/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>
<? $footerdata['js'][] = base_url('vendor/almasaeed2010/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>
<? $footerdata['js'][] = base_url('vendor/almasaeed2010/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>
<? $footerdata['js'][] = base_url('vendor/almasaeed2010/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>
<? $footerdata['js'][] = base_url('vendor/almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>
<? $footerdata['js'][] = base_url('vendor/almasaeed2010/adminlte/plugins/jszip/jszip.min.js'); ?>
<? $footerdata['js'][] = base_url('vendor/almasaeed2010/adminlte/plugins/pdfmake/pdfmake.min.js'); ?>
<? $footerdata['js'][] = base_url('vendor/almasaeed2010/adminlte/plugins/pdfmake/vfs_fonts.js'); ?>
<? $footerdata['js'][] = base_url('vendor/almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>
<? $footerdata['js'][] = base_url('vendor/almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.print.min.js'); ?>
<? $footerdata['js'][] = base_url('vendor/almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>

<? $footerdata['css'][] = base_url('vendor/almasaeed2010/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>
<? $footerdata['css'][] = base_url('vendor/almasaeed2010/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>
<? $footerdata['css'][] = base_url('vendor/almasaeed2010/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>

<? $footerdata['js'][] = base_url('public/js/socios-crud.js'); ?>

<?= view('elements/footer.php',$footerdata); ?>