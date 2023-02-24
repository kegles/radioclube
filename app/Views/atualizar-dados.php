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
                    <h1><?= _('Atualizar dados'); ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mr-3 ml-3">
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="<?=base_url('/atualizar-dados/dadosBasicos');?>">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><?= _('Geral'); ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>CPF</label>
                                <p><?=$cpf;?></p>
                            </div>  
                            <div class="form-group">
                                <label>Nome completo</label>
                                <p><?=$nome;?></p>
                            </div>     
                            <div class="form-group">
                                <label>Data de nascimento</label>
                                <p><?=rcDateFromDb($dataNascimento);?></p>
                            </div>                                                    
                            <div class="form-group">
                                <label for="txtEmail">Endereço de e-mail &nbsp;&nbsp; <small>(será usado para entrar na Área de Sócios)</small></label>
                                <input type="text" id="txtEmail" name="email" class="form-control" value="<?=$email;?>">
                            </div>  
                            <div class="form-group">
                                <label for="txtTelefone">Telefone/WhatsApp</label>
                                <input type="text" id="txtTelefone" name="telefone" class="form-control" value="<?=$telefone;?>">
                            </div>                      
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-success" title="<?=_('Alterar minha senha de acesso');?>"><i class="fas fa-key mr-1"></i> <?=_('Alterar minha senha');?></button>
                            <button type="submit" class="btn btn-primary float-right" title="<?=_('Atualizar seus dados');?>"><i class="fas fa-check mr-1"></i> <?=_('Atualizar');?></button>
                        </div>
                    </div>
                </form>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?= _('Licenças'); ?></h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?= _('Indicativo'); ?></th>
                                    <th><?= _('Tipo'); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PY3RCP</td>
                                    <td>Classe A</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <form method="post" action="<?=base_url('/atualizar-dados/excluiLicenca');?>">
                                                <button type="button" class="btn btn-danger" title="<?=_('Excluir licença de estação');?>"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PP3PEL</td>
                                    <td>Especial</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <form method="post" action="<?=base_url('/atualizar-dados/excluiLicenca');?>">
                                                <button type="button" class="btn btn-danger" title="<?=_('Excluir licença de estação');?>"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PX3P3030</td>
                                    <td>PX</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <form method="post" action="<?=base_url('/atualizar-dados/excluiLicenca');?>">
                                                <button type="button" class="btn btn-danger" title="<?=_('Excluir licença de estação');?>"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary"  title="<?=_('Adicionar nova licença de estação');?>"><i class="fas fa-plus mr-1"></i> <?=_('Adicionar');?></button>
                    </div>                    
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.card -->
</div>
<?php 
    $data = array(
        'js' => array(
            base_url('vendor/igorescobar/jquery-mask-plugin/dist/jquery.mask.min.js'),
            base_url('public/js/atualiza-dados.js'),
        ),
    ); 
    if (isset($toastr)) {
        $data['toastr'] = $toastr;
    }
    echo view('elements/footer.php',$data); 
?>