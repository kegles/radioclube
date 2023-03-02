<? 
  if (isset($css) && is_array($css)) { 
    foreach ($css as $cssfile) {
    ?>
    <link rel="stylesheet" href="<?=$cssfile;?>" />
    <?
    }
  }
?>
<!-- AdminLTE App -->
<script src="<?=base_url('vendor/components/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js')?>"></script>
<? if (isset($js) && is_array($js)): ?>
  <? foreach ($js as $jsfile): ?>
    <script type="text/javascript" src="<?=$jsfile;?>"></script>
  <? endforeach; ?>
<? endif; ?>
<!-- toastr -->
<link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/plugins/toastr/toastr.min.css'); ?>" />
<script type="text/javascript" src="<?=base_url('vendor/almasaeed2010/adminlte/plugins/toastr/toastr.min.js'); ?>"></script>
<?
    //retorna a variável toastr da sessão para a página
    if (count(session()->getFlashdata('toastr')??[])>0) {
        $data = session()->getFlashdata('toastr');
    }
?>
<? if (isset($toastr) && is_array($toastr)): ?>
  <script type="text/javascript">
  <? 
    foreach ($toastr as $toastr_item) {
      if (isset($toastr_item['type'])) {
        if ($toastr_item['type']=='success') {
          ?>
            toastr.success('<?=$toastr_item['text'];?>');
          <?
        }
        elseif ($toastr_item['type']=='error') {
          ?>
            toastr.error('<?=$toastr_item['text'];?>');
          <?
        }
        elseif ($toastr_item['type']=='warning') {
          ?>
            toastr.warning('<?=$toastr_item['text'];?>');
          <?
        }
        else {
          ?>
            toastr.info('<?=$toastr_item['text'];?>');
          <?
        }

      }
    } 
  ?>
  </script>
<? endif; ?>


</body>
</html>