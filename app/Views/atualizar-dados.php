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

                            <?php if (session()->getFlashdata('error')): ?>
                            <div class="pb-2 mb-3 alert alert-danger alert-dismissible">
                                <h5><i class="icon fas fa-ban"></i> <?=_('Erro');?></h5>
                                <?=session()->getFlashdata('error');?>
                            </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('success')): ?>
                            <div class="pb-2 mb-3 alert alert-success alert-dismissible">
                                <h5><i class="icon fas fa-check"></i> <?=_('Sucesso');?></h5>
                                <?=session()->getFlashdata('success');?>
                            </div>
                            <?php endif; ?>


                            <div class="form-group">
                                <label><?=_('CPF');?></label>
                                <p><?=$cpf;?></p>
                            </div>  
                            <div class="form-group">
                                <label><?=_('Nome completo');?></label>
                                <p><?=$nome;?></p>
                            </div>     
                            <div class="form-group">
                                <label><?=_('Data de nascimento');?></label>
                                <p><?=rcDateFromDb($dataNascimento);?></p>
                            </div>                                                    
                            <div class="form-group">
                                <label for="txtEmail"><?=_('Endereço de e-mail');?> &nbsp;&nbsp; <small>(<?=_('será usado para entrar aqui');?>)</small></label>
                                <input type="text" id="txtEmail" name="email" class="form-control" value="<?=$email;?>">
                            </div>  
                            <div class="form-group">
                                <label for="txtTelefone"><?=_('Telefone/WhatsApp');?></label>
                                <input type="text" id="txtTelefone" name="telefone" class="form-control" value="<?=$telefone;?>">
                            </div>                      
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a class="btn btn-success" title="<?=_('Alterar minha senha de acesso');?>" href="<?=base_url('alterar-senha');?>"><i class="fas fa-key mr-1"></i> <?=_('Alterar minha senha');?></a>
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
                                <? if (!isset($licencas) || (!is_array($licencas)) || (count($licencas)==0)): ?>
                                <tr>
                                    <td colspan="3" class="text-center"><?=_('Sem licenças cadastradas.');?></td>
                                </tr>
                                <? else: ?>
                                    <? foreach ($licencas as $licenca): ?>
                                    <tr>
                                        <td><?=$licenca['indicativo'];?></td>
                                        <td><?=rcTipoLicencaLabel($licenca['tipo']);?></td>
                                        <td class="text-right py-0 align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <form method="post" action="<?=base_url('/atualizar-dados/excluirEstacao');?>">
                                                    <input type="hidden" name="indicativo" value="<?=$licenca['indicativo'];?>" />
                                                    <button type="submit" class="btn btn-danger apagarLicenca" title="<?=_('Excluir licença de estação');?>"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <? endforeach; ?>
                                <? endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLicenca" title="<?=_('Adicionar nova licença de estação');?>"><i class="fas fa-plus mr-1"></i> <?=_('Adicionar');?></button>
                    </div>                    
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.card -->
</div>

<div class="modal fade" id="addLicenca" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method="post" action="<?=base_url('/atualizar-dados/incluirEstacao');?>">
                <div class="modal-header">
                    <h4 class="modal-title"><?=_('Adicionar licença');?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="txtModalIndicativo"><?=_('Indicativo');?></label>
                        <input type="text" id="txtModalIndicativo" name="indicativo" class="form-control" style="text-transform:uppercase;" value="">
                    </div>  
                    <div class="form-group">
                        <label for="slcModalTipo"><?=_('Tipo');?></label>
                        <select id="slcModalTipo" name="tipo" class="form-control">
                            <option value="CA">Classe A</option>
                            <option value="CB">Classe B</option>
                            <option value="CC">Classe C</option>
                            <option value="PX">Faixa do cidadão</option>
                            <option value="EE">Estação especial</option>
                            <option value="ER">Estação repetidora</option>
                        </select>
                    </div>                       
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary"><i class="fa fa-check mr-1"></i> <?=_('Salvar');?></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php 
    $data = array(
        'js' => array(
            base_url('vendor/igorescobar/jquery-mask-plugin/dist/jquery.mask.min.js'),
            base_url('vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'),
            base_url('public/js/atualiza-dados.js'),
        ),
    ); 
    if (isset($toastr)) {
        $data['toastr'] = $toastr;
    }
    echo view('elements/footer.php',$data); 
?>