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
                    <h1><?= _('Alterar senha'); ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mr-3 ml-3">
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="<?=base_url('/alterar-senha');?>">
                    <div class="card card-primary">
                        <div class="card-body">

                            <?php if (session()->getFlashdata('error')): ?>
                            <div class="pb-2 mb-3 alert alert-danger alert-dismissible">
                                <h5><i class="icon fas fa-ban"></i> <?=_('Erro');?></h5>
                                <?=session()->getFlashdata('error');?>
                            </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="txtSenha"><?=_('Senha antiga');?> &nbsp;&nbsp; <small>(<?=_('senha que você está utilizando agora');?>)</small></label>
                                <input type="password" id="txtSenha" name="senha" class="form-control <?=isset(session()->getFlashdata('errors')['senha']) ? 'is-invalid':''; ?>" />
                                <span class="error invalid-feedback">
                                    <?=session()->getFlashdata('errors')['senha'] ?? ''; ?>
                                </span>                            
                            </div>  

                            <div class="form-group">
                                <label for="txtNovaSenha"><?=_('Nova senha');?></label>
                                <input type="password" id="txtNovaSenha" name="novaSenha" class="form-control <?=isset(session()->getFlashdata('errors')['novaSenha']) ? 'is-invalid':''; ?>" />
                                <span class="error invalid-feedback">
                                    <?=session()->getFlashdata('errors')['novaSenha'] ?? ''; ?>
                                </span>  
                            </div>  

                            <div class="form-group">
                                <label for="txtConfirmacao"><?=_('Confirmação');?> &nbsp;&nbsp; <small>(<?=_('digite a nova senha novamente');?>)</small></label>
                                <input type="password" id="txtConfirmacao" name="confirmacao" class="form-control <?=isset(session()->getFlashdata('errors')['confirmacao']) ? 'is-invalid':''; ?>" />
                                <span class="error invalid-feedback">
                                    <?=session()->getFlashdata('errors')['confirmacao'] ?? ''; ?>
                                </span>                              
                            </div>  

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right" title="<?=_('Alterar sua senha');?>"><i class="fas fa-check mr-1"></i> <?=_('Alterar');?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    
<?php 
    $data = array(
        'js' => array(
            base_url('vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'),
            base_url('public/js/alterar-senha.js'),
        ),
    ); 
    if (isset($toastr)) {
        $data['toastr'] = $toastr;
    }
    echo view('elements/footer.php',$data); 
?>