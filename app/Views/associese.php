<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=rcTitle(array(_('Associe-se'))); ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/dist/css/adminlte.min.css');?>">
</head>
<body class="hold-transition register-page">

  <div class="register-logo">
    <?=_('Associação');?>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg text-bold"><?=_('Formulário de pré-associação, leia atentamente:');?></p>

      <form method="post">
        <div class="pb-2 mb-3 text-center">
          <?=_('
                Este formulário não o qualifica automaticamente como sócio do <br>
                clube, pois sua ficha será lida, aprovada em reunião específica e,<br>
                sua associação registrada em ata, conforme rege nosso estatuto.
          ');?>
        </div>
        <div class="input-group mb-3">
            <input type="text" name="cpf" class="form-control <?php echo isset(session()->getFlashdata('errors')['cpf']) ? 'is-invalid':''; ?>" placeholder="<?=_('CPF');?>" maxlength="14">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-passport"></span>
                </div>
            </div>
            <span class="error invalid-feedback">
              <?php echo session()->getFlashdata('errors')['cpf'] ?? ''; ?>
            </span>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="nome" class="form-control <?php echo isset(session()->getFlashdata('errors')['nome']) ? 'is-invalid':''; ?>" placeholder="<?=_('Nome completo');?>" maxlength="255">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?php echo session()->getFlashdata('errors')['nome'] ?? ''; ?>
          </span>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="celular" class="form-control <?php echo isset(session()->getFlashdata('errors')['celular']) ? 'is-invalid':''; ?>" placeholder="<?=_('Celular/WhatsApp');?>" maxlength="15">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?php echo session()->getFlashdata('errors')['celular'] ?? ''; ?>
          </span>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control <?php echo isset(session()->getFlashdata('errors')['email']) ? 'is-invalid':''; ?>" placeholder="<?=_('E-mail');?>" maxlength="255">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?php echo session()->getFlashdata('errors')['email'] ?? ''; ?>
          </span>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="indicativo" class="form-control <?php echo isset(session()->getFlashdata('errors')['indicativo']) ? 'is-invalid':''; ?>" placeholder="<?=_('Indicativo PX ou de radioamador');?>" maxlength="8">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?php echo session()->getFlashdata('errors')['indicativo'] ?? ''; ?>
          </span>
        </div>               
        <div class="input-group mb-3">
            <small>
                * <?=_('É necessário estar regular na Anatel');?>
                <br />
                ** <?=_('Depois poderá adicionar outros indicativos');?>
            </small>
        </div>               
        <div class="input-group mb-3">
          <input type="password" name="senha" class="form-control <?php echo isset(session()->getFlashdata('errors')['senha']) ? 'is-invalid':''; ?>" placeholder="<?=_('Senha');?>" maxlength="20">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?php echo session()->getFlashdata('errors')['senha'] ?? ''; ?>
          </span>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="confirmacao" class="form-control" placeholder="<?=_('Senha novamente');?>" maxlength="20">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="concordo" name="concordo" value="sim">
              <label for="concordo">
               <?=sprintf(_('Eu aceito os <a href="%s" target="_blank">termos</a>'),base_url('termos-do-associado'));?>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block"><?=_('Enviar'); ?></button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.form-box -->
  </div>

<!-- AdminLTE App -->
<script src="<?=base_url('vendor/components/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js')?>"></script>
<script src="<?=base_url('vendor/igorescobar/jquery-mask-plugin/dist/jquery.mask.min.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        <?php if (session()->getFlashdata('errors')): ?>
        $('.invalid-feedback').show();
        <?php endif; ?>
        $('input[name="cpf"]').mask('000.000.000-00', {reverse: true});
        $('input[name="celular"]').mask('(00) 00000-0000');
        $('input[name="cpf"]').focus(); 
    });
</script>
</body>
</html>
