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
                    <h1><?=isset($id)?sprintf(_('Editando o evento #%s'),$id):_('Novo evento'); ?></h1>
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
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txtData"><?=_('Data');?></label>
                        <input type="text" id="txtData" name="data" class="form-control <?=isset(session()->getFlashdata('errors')['data']) ? 'is-invalid':''; ?>" value="<?=rcDateFromDb($data);?>" />
                        <span class="error invalid-feedback">
                            <?=session()->getFlashdata('errors')['data'] ?? ''; ?>
                        </span>                            
                    </div>  
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label for="txtTitulo"><?=_('Título');?></label>
                        <input type="text" id="txtTitulo" name="titulo" class="form-control <?=isset(session()->getFlashdata('errors')['titulo']) ? 'is-invalid':''; ?>" value="<?=$titulo;?>" />
                        <span class="error invalid-feedback">
                            <?=session()->getFlashdata('errors')['titulo'] ?? ''; ?>
                        </span>                            
                    </div>  
                </div>
            </div>
            <? if (isset($_PARTICIPANTES) && is_array($_PARTICIPANTES) && (count($_PARTICIPANTES)>0)): ?>
            <div class="row">
                <div class="col-sm-12"><hr /></div>
            </div>
            <div class="row">
                <div class="col-sm-12"><h6 class="ml-1 text-bold"><?=_('PARTICIPANTES');?> (<?=count($_PARTICIPANTES);?>)</h6></div>
            </div>
                <? foreach ($_PARTICIPANTES as $index => $participante): ?>
                    <div class="row">
                        <div class="col-sm-12"><h6 class="ml-1"><?=$index+1;?> - <?=$participante['nome'];?> (<?=$participante['indicativo'];?>)</h6></div>
                    </div>
                <? endforeach; ?>
            <? endif; ?>
            <div class="row">
                <div class="col-sm-12"><hr /></div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <a href="<?=base_url('eventos');?>" class="btn btn-warning float-left"><i class="fa fa-arrow-left mr-2"></i> <?=_('<b>Cancelar</b> e voltar');?></a>
                    <button type="submit" class="btn btn-success float-right"><i class="fa fa-check mr-2"></i> <?=_('<b>Salvar</b> e continuar');?></button>
                </div>
                <div class="col-sm-3">
                </div>                
            </div>
        </section>
    </form>

</div>

<? $footerdata['js'][] = base_url('vendor/igorescobar/jquery-mask-plugin/dist/jquery.mask.min.js'); ?>
<? $footerdata['js'][] = base_url('public/js/eventos-ficha.js'); ?>

<?= view('elements/footer.php',$footerdata); ?>