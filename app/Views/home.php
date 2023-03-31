<? $footerdata = []; ?>

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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <p class="mt-3 mb-5"><i class="fa fa-arrow-left"></i> Para <b>atualizar seus dados</b> clique no seu indicativo, no menu ao lado.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3><?=_('Eventos');?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th style="width:50%"><?=_('O quê?');?></th>
                                    <th style="width:20%" class="text-center"><?=_('Quando?');?></th>
                                    <th style="width:30%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? if (!isset($eventos) || !is_array($eventos) || count($eventos)==0): ?>
                                    <tr>
                                        <td colspan="3" class="text-center"><?=_('Sem eventos programados...');?></td>
                                    </tr>
                                <? else: ?>
                                    <? foreach ($eventos as $evento): ?>
                                    <? 
                                        $confirmou=false;
                                        foreach ($evento['_PARTICIPANTES'] as $participante) {
                                            if ($participante['idSocio']==session()->get()['id']) {
                                                $confirmou=true;
                                            }
                                        } 
                                    ?>
                                    <tr>
                                        <td style="width:50%"><?=$evento['titulo'];?></td>
                                        <td style="width:20%" class="text-center"><?=rcDateFromDb($evento['data']);?></td>
                                        <td style="width:30%" class="text-center evento-confirmacao-<?=$evento['id'];?>">
                                            <a style="<?=$confirmou?'display:show;':'display:none;';?>" class="text-success"><i class="fa fa-check-double"></i> <?=_('Presença confirmada');?></a>
                                            <a style="<?=$confirmou?'display:none;':'display:show;';?>" class="text-primary" href="<?=base_url('participe?evento='.$evento['id']);?>"><i class="fa fa-check"></i> <?=_('Confirmar presença');?></a>
                                        </td>
                                    </tr>       
                                    <? endforeach; ?>
                                <? endif; ?>                         
                            </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h4 class="text-bold"><?=_('Plano de gestão');?></h4>
                                    <p><?=_('Conheça o plano de gestão do clube');?></p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-book"></i>
                                </div>
                                <a href="<?=base_url('public/PLANO_GESTAO.pdf');?>" target="_blank" class="small-box-footer"><?=_('Ler online');?> <i class="ml-2 fas fa-arrow-right"></i></a>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<? $footerdata['css'][] = base_url('vendor/driftyco/ionicons/css/ionicons.min.css'); ?>

<? $footerdata['js'][] = base_url('public/js/home-eventos.js'); ?>

<?=view('elements/footer.php',$footerdata);?>
