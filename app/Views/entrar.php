<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=rcTitle(array(_('Entrar'))); ?></title>

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
    <?=_('Autenticação');?>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><?=_('Digite suas informações para entrar');?></p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="<?=_('E-mail');?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="senha" class="form-control" placeholder="<?=_('Senha');?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="lembrar" id="lembrar">
              <label for="lembrar">
                <?=_('Lembrar dados');?>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block"><?=_('Entrar');?></button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="<?=base_url('recuperar-senha');?>"><?=_('Esqueci minha senha');?></a>
      </p>
      <p class="mb-0">
        <a href="<?=base_url('associe-se');?>" class="text-center text-bold"><?=_('Associe-se agora mesmo');?></a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- AdminLTE App -->
<script src="<?=base_url('vendor/components/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js')?>"></script>
<script type="text/javascript">
  $(document).ready(function() { $('input[name="email"]').focus(); });
</script>
</body>
</html>
