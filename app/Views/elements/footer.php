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