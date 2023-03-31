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
                    <h1><?=isset($id)?sprintf(_('Editando o sócio #%s'),$id):_('Novo sócio'); ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <form method="post">
        <section class="content mr-3 ml-3">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="slcAtivo"><?=_('Ativo');?></label>
                        <select id="slcAtivo" name="ativo" class="form-control <?=isset(session()->getFlashdata('errors')['ativo']) ? 'is-invalid':''; ?>" />
                            <option value="Y" <?=$ativo=='Y'?'selected':null?>><?=_('Sim');?></option>
                            <option value="N" <?=$ativo=='N'?'selected':null?>><?=_('Não');?></option>
                        </select>
                        <span class="error invalid-feedback">
                            <?=session()->getFlashdata('errors')['ativo'] ?? ''; ?>
                        </span>                           
                    </div>  
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="slcAprovado"><?=_('Aprovado');?></label>
                        <select id="slcAprovado" name="aprovado" class="form-control <?=isset(session()->getFlashdata('errors')['aprovado']) ? 'is-invalid':''; ?>" />
                            <option value="Y" <?=$aprovado=='Y'?'selected':null?>><?=_('Sim');?></option>
                            <option value="N" <?=$aprovado=='N'?'selected':null?>><?=_('Não');?></option>
                        </select>
                        <span class="error invalid-feedback">
                            <?=session()->getFlashdata('errors')['aprovado'] ?? ''; ?>
                        </span>                           
                    </div>  
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txtCPF"><?=_('CPF');?></label>
                        <input type="text" id="txtCPF" name="cpf" class="form-control <?=isset(session()->getFlashdata('errors')['cpf']) ? 'is-invalid':''; ?>" value="<?=$cpf;?>" />
                        <span class="error invalid-feedback">
                            <?=session()->getFlashdata('errors')['cpf'] ?? ''; ?>
                        </span>                            
                    </div>  
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="txtNome"><?=_('Nome');?></label>
                        <input type="text" id="txtNome" name="nome" class="form-control <?=isset(session()->getFlashdata('errors')['nome']) ? 'is-invalid':''; ?>" value="<?=$nome;?>" />
                        <span class="error invalid-feedback">
                            <?=session()->getFlashdata('errors')['nome'] ?? ''; ?>
                        </span>                            
                    </div>  
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txtEmail"><?=_('E-mail');?></label>
                        <input type="text" id="txtEmail" name="email" class="form-control <?=isset(session()->getFlashdata('errors')['email']) ? 'is-invalid':''; ?>" value="<?=$email;?>" />
                        <span class="error invalid-feedback">
                            <?=session()->getFlashdata('errors')['email'] ?? ''; ?>
                        </span>                            
                    </div>  
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txtTelefone"><?=_('Telefone');?></label>
                        <input type="text" id="txtTelefone" name="telefone" class="form-control <?=isset(session()->getFlashdata('errors')['telefone']) ? 'is-invalid':''; ?>" value="<?=$telefone;?>" />
                        <span class="error invalid-feedback">
                            <?=session()->getFlashdata('errors')['telefone'] ?? ''; ?>
                        </span>                            
                    </div>  
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txtDataNascimento"><?=_('Data de nascimento');?></label>
                        <input type="text" id="txtDataNascimento" name="dataNascimento" class="form-control <?=isset(session()->getFlashdata('errors')['dataNascimento']) ? 'is-invalid':''; ?>" value="<?=rcDateFromDb($dataNascimento);?>" />
                        <span class="error invalid-feedback">
                            <?=session()->getFlashdata('errors')['dataNascimento'] ?? ''; ?>
                        </span>                            
                    </div>  
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12"><hr /></div>
            </div>
            <div class="row">
                <div class="col-sm-12"> 
                    <div class="row">
                        <div class="col-sm-3">
                            <b><?=_('Indicativo');?></b>
                        </div> 
                        <div class="col-sm-2">
                            <b><?=_('Tipo');?></b>
                        </div> 
                    </div>                    
                    <? foreach ($_LICENCAS as $index => $licenca):  ?>
                        <div class="row mt-2 licenca-row" data-index="<?=$index+1;?>">
                           <div class="col-sm-3">
                                <input type="text" name="_LICENCAS[<?=$index+1;?>][indicativo]" class="form-control text-uppercase" value="<?=$licenca['indicativo'];?>" />
                           </div> 
                           <div class="col-sm-2">
                                <select name="_LICENCAS[<?=$index+1;?>][tipo]" class="form-control">
                                    <? foreach ($_LICENCAS_TIPOS as $ti => $tl): ?>
                                    <option value="<?=$ti;?>" <?=($ti==$licenca['tipo'])?'selected':'';?>><?=$tl;?></option>
                                    <? endforeach; ?>
                                </select>
                           </div> 
                           <div class="col-sm-1">
                                <a href="javascript:;" class="btn btn-danger licencas-del" title="<?=_('Apagar licença');?>"><i class="fa fa-trash"></i></a>
                           </div>
                        </div>
                    <? endforeach; ?>
                    <div class="row licenca-new mt-2" data-index="0">
                        <div class="col-sm-3">
                            <input type="text" name="_LICENCAS[0][indicativo]" class="form-control text-uppercase" value="" />
                        </div> 
                        <div class="col-sm-2">
                            <select name="_LICENCAS[0][tipo]" class="form-control">
                                <? foreach ($_LICENCAS_TIPOS as $ti => $tl): ?>
                                <option value="<?=$ti;?>"><?=$tl;?></option>
                                <? endforeach; ?>
                            </select>
                        </div> 
                        <div class="col-sm-1">
                            <a href="javascript:;" class="btn btn-primary licencas-add" title="<?=_('Adicionar licença');?>"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12"><hr /></div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <a href="<?=base_url('socios');?>" class="btn btn-warning float-left"><i class="fa fa-arrow-left mr-2"></i> <?=_('<b>Cancelar</b> e voltar');?></a>
                    <button type="submit" class="btn btn-success float-right"><i class="fa fa-check mr-2"></i> <?=_('<b>Salvar</b> e continuar');?></button>
                </div>
                <div class="col-sm-4">
                </div>                
            </div>
        </section>
    </form>

</div>

<? $footerdata['js'][] = base_url('vendor/igorescobar/jquery-mask-plugin/dist/jquery.mask.min.js'); ?>
<? $footerdata['js'][] = base_url('public/js/socios-ficha.js?v=2'); ?>

<?= view('elements/footer.php',$footerdata); ?>