<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=rcTitle(array(_('Recuperação de senha'))); ?></title>

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
    <?=_('Recuperar senha');?>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">
            <?
                echo _('Digite seu e-mail e sua senha (por duas vezes) para atualizar seus dados.');
            ?>
      </p>

      <form method="post">

        <input type="hidden" name="hash" value="<?=$hash;?>" />

        <?php if (session()->getFlashdata('error')): ?>
          <div class="pb-2 mb-3 alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> <?=_('Erro');?></h5>
            <?=session()->getFlashdata('error');?>
          </div>
        <?php endif; ?>

        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control <?=isset(session()->getFlashdata('errors')['email']) ? 'is-invalid':''; ?>" placeholder="<?=_('E-mail');?>"  maxlength="255" value="<?=$email;?>" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?=session()->getFlashdata('errors')['novaSenha'] ?? ''; ?>
          </span>
        </div>        

        <div class="input-group mb-3">
          <input type="password" name="novaSenha" class="form-control <?=isset(session()->getFlashdata('errors')['novaSenha']) ? 'is-invalid':''; ?>" placeholder="<?=_('Senha');?>"  maxlength="20" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?=session()->getFlashdata('errors')['novaSenha'] ?? ''; ?>
          </span>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="confirmacao" class="form-control <?=isset(session()->getFlashdata('errors')['confirmacao']) ? 'is-invalid':''; ?>" placeholder="<?=_('Confirmação');?>"  maxlength="20" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?=session()->getFlashdata('errors')['novaSenha'] ?? ''; ?>
          </span>
        </div>
       
          <!-- /.col -->
          <div class="input-group">
            <button type="submit" class="btn btn-primary float-right"><?=_('Alterar senha');?></button>
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
    $('input[name="email"]').focus(); 
    $('input.is-invalid')[0].focus();
  });
</script>
</body>
</html>
