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
                    <h1><?=sprintf(_('Apagar o evento #%s'),$id); ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <form method="post">
        <section class="content mr-3 ml-3">
            <div class="row">
                <div class="col-sm-12"><?=sprintf(_('Deseja realmente apagar o evento <b>%s</b> programado para <b>%s</b>?'),$titulo,rcDateFromDb($data));?></div>
            </div>
            <div class="row">
                <div class="col-sm-12"><hr /></div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <a href="<?=base_url('eventos');?>" class="btn btn-warning float-left"><i class="fa fa-arrow-left mr-2"></i> <?=_('<b>Não</b>, voltar');?></a>
                    <button type="submit" class="btn btn-success float-right"><i class="fa fa-check mr-2"></i> <?=_('<b>Sim</b>, apagar');?></button>
                </div>
                <div class="col-sm-4">
                </div>                
            </div>
        </section>
    </form>

</div>

<? $footerdata['js'][] = base_url('vendor/igorescobar/jquery-mask-plugin/dist/jquery.mask.min.js'); ?>
<? $footerdata['js'][] = base_url('public/js/eventos-ficha.js'); ?>

<?= view('elements/footer.php',$footerdata); ?>