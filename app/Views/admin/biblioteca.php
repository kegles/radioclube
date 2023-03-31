<?
    //retorna os toasters, pois pode ter vindo da altera-senha uma mensagem
    if (is_array(session()->getFlashdata('toastr'))) {
        $toastr[] = session()->getFlashdata('toastr');
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
                    <h1><?=_('Biblioteca'); ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <iframe src="https://drive.google.com/embeddedfolderview?id=1pP6NrUMQxXYxUhkMM5lAc57AaTm-CR_9#list" style="width:100%; height:600px; border:0;"></iframe>

</div>

<?= view('elements/footer.php'); ?>