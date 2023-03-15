<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=rcTitle(array(_('Participe dos nossos eventos'))); ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/dist/css/adminlte.min.css');?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <?=_('Confirmar presença');?>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">
            <? if (count($eventos)>1): ?>
            <?
                echo sprintf(
                    _('Selecione o evento e informe seu nome e indicativo, em caso de dúvidas entre em <a href="%s">contato conosco</a>.'),
                    base_url('contato')
                );
            ?>
            <? else: ?>
            <?
                echo sprintf(
                    _('Informe seu nome e indicativo para confirmar presença em <b>%s</b>, em caso de dúvidas entre em <a href="%s">contato conosco</a>.'),
                    $eventos[0]['titulo'],
                    base_url('contato')
                );
            ?>
            <? endif; ?>
      </p>

      <form method="post">

        <?php if (session()->getFlashdata('success')): ?>
          <div class="pb-2 mb-3 alert alert-success alert-dismissible">
            <h5><i class="icon fas fa-check"></i> <?=_('Sucesso');?></h5>
            <?=session()->getFlashdata('success');?>
          </div>
        <?php endif; ?>

        <? if (count($eventos)>1): ?>
        <div class="input-group mb-3">
          <select name="evento" class="form-control <?=isset(session()->getFlashdata('errors')['evento']) ? 'is-invalid':''; ?>" placeholder="<?=_('Evento');?>">
          <? foreach ($eventos as $evento): ?>
            <option value="<?=$evento['id'];?>"><?=$evento['titulo'];?> (<?=rcDateFromDb($evento['data']);?>)</option>
          <? endforeach; ?>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-calendar"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?=session()->getFlashdata('errors')['evento'] ?? ''; ?>
          </span>
        </div>
        <? else: ?>
            <input type="hidden" name="evento" value="<?=$eventos[0]['id'];?>" />
        <? endif; ?>
        <div class="input-group mb-3">
          <input type="text" name="nome" class="form-control <?=isset(session()->getFlashdata('errors')['nome']) ? 'is-invalid':''; ?>" placeholder="<?=_('Nome');?>"  maxlength="255" value="<?=$nome;?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?=session()->getFlashdata('errors')['nome'] ?? ''; ?>
          </span>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="indicativo" class="form-control" placeholder="<?=_('Indicativo (opcional)');?>"  maxlength="10" value="<?=$indicativo;?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-broadcast-tower"></span>
            </div>
          </div>
        </div>
        <!-- /.col -->
          <div class="input-group">
            <button type="submit" class="btn btn-primary float-right"><?=_('Confirmar presença');?></button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- AdminLTE App -->
<script src="<?=base_url('vendor/components/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js')?>"></script>
<script type="text/javascript">
  $(document).ready(function() { 
    <?php if (session()->getFlashdata('errors')): ?>
        $('.invalid-feedback').show();
    <?php endif; ?>    
    $('input[name="nome"]').focus();
    $('select[name="evento"]').focus(); 
    $('input.is-invalid')[0].focus();
  });
</script>
</body>
</html>
