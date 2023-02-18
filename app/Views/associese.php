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
        <?php if (session()->getFlashdata('error')): ?>
        <div class="pb-2 mb-3 alert alert-danger alert-dismissible">
          <h5><i class="icon fas fa-ban"></i> <?=_('Erro');?></h5>
          <?=session()->getFlashdata('error');?>
        </div>
        <?php endif; ?>
        <div class="input-group mb-3">
            <input type="text" name="cpf" class="form-control <?=isset(session()->getFlashdata('errors')['cpf']) ? 'is-invalid':''; ?>" placeholder="<?=_('CPF');?>" maxlength="14" value="<?=old('cpf');?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-passport"></span>
                </div>
            </div>
            <span class="error invalid-feedback">
              <?=session()->getFlashdata('errors')['cpf'] ?? ''; ?>
            </span>
        </div>
        <div class="input-group mb-3">
            <input type="text" name="dataNascimento" class="form-control <?=isset(session()->getFlashdata('errors')['dataNascimento']) ? 'is-invalid':''; ?>" placeholder="<?=_('Data de nascimento');?>" maxlength="10" value="<?=old('dataNascimento');?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-calendar"></span>
                </div>
            </div>
            <span class="error invalid-feedback">
              <?=session()->getFlashdata('errors')['dataNascimento'] ?? ''; ?>
            </span>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="nome" class="form-control <?=isset(session()->getFlashdata('errors')['nome']) ? 'is-invalid':''; ?>" placeholder="<?=_('Nome completo');?>" maxlength="255" value="<?=old('nome');?>">
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
          <input type="text" name="telefone" class="form-control <?=isset(session()->getFlashdata('errors')['telefone']) ? 'is-invalid':''; ?>" placeholder="<?=_('Telefone/WhatsApp');?>" maxlength="15" value="<?=old('telefone');?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?=session()->getFlashdata('errors')['telefone'] ?? ''; ?>
          </span>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control <?=isset(session()->getFlashdata('errors')['email']) ? 'is-invalid':''; ?>" placeholder="<?=_('E-mail');?>" maxlength="255" value="<?=old('email');?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?=session()->getFlashdata('errors')['email'] ?? ''; ?>
          </span>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="indicativo" class="form-control <?=isset(session()->getFlashdata('errors')['indicativo']) ? 'is-invalid':''; ?>" placeholder="<?=_('Indicativo da estação ou PX');?>" maxlength="8" value="<?=old('indicativo');?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?=session()->getFlashdata('errors')['indicativo'] ?? ''; ?>
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
          <input type="password" name="senha" class="form-control <?=isset(session()->getFlashdata('errors')['senha']) ? 'is-invalid':''; ?>" placeholder="<?=_('Senha');?>" maxlength="20" value="<?=old('senha');?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?=session()->getFlashdata('errors')['senha'] ?? ''; ?>
          </span>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="confirmacao" class="form-control <?=isset(session()->getFlashdata('errors')['confirmacao']) ? 'is-invalid':''; ?>" placeholder="<?=_('Confirme a senha');?>" maxlength="20" value="<?=old('confirmacao');?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <span class="error invalid-feedback">
            <?=session()->getFlashdata('errors')['confirmacao'] ?? ''; ?>
          </span>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="concordo" name="concordo" value="sim" <?=old('concordo')=='sim'?'checked':'';?>>
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
        var phoneMaskBehavior = function (val) {
          return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        phoneOptions = {onKeyPress: function(val, e, field, options) {
                field.mask(phoneMaskBehavior.apply({}, arguments), options);
            }
        };
        $('input[name="cpf"]').mask('000.000.000-00', {reverse: true});
        $('input[name="telefone"]').mask(phoneMaskBehavior, phoneOptions);
        $('input[name="dataNascimento"]').mask('00/00/0000');
        $('input[name="cpf"]').focus();
        $('input.is-invalid')[0].focus(); 
    });
</script>
</body>
</html>
