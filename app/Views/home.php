<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=rcTitle(array(_('Área de Sócios'))); ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/dist/css/adminlte.min.css');?>">
</head>
<body class="sidebar-mini" style="height:auto;">
    <div class="wrapper">
        <!-- sidebar -->
        <?=view('elements/sidebar.php');?>
        <!-- content -->
    </div>

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