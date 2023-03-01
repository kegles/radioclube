<?=view('elements/header.php');?>
    <div class="wrapper">
        <!-- sidebar -->
        <?=view('elements/sidebar.php');?>
    <!-- content -->
    </div>


<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header mr-3 ml-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= _('Área de Sócios'); ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mr-3 ml-3">
        <p class="mt-3 mb-5"><i class="fa fa-arrow-left"></i> Para <b>atualizar seus dados</b> clique no seu nome, no menu ao lado.</p>
        <h1>Caro(a) <?=explode(chr(32),$nome)[0];?>, bem vindo ao Rádio Clube de Pelotas!</h1>
        <p>Em breve essa página mostrará informações relevantes sobre sua associação ao RCP, aguarde por novidades.</p>
    </section>
</div>


<?=view('elements/footer.php');?>
