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
                    <h1><?= _('Atualizar dados'); ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mr-3 ml-3">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?= _('Geral'); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="txtNomeCompleto">Nome completo</label>
                            <input type="text" id="txtNomeCompleto" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="txtEmail">Endereço de e-mail &nbsp;&nbsp; <small>(será usado para entrar na Área de Sócios)</small></label>
                            <input type="text" id="txtEmail" class="form-control" value="">
                        </div>  
                        <div class="form-group">
                            <label for="txtTelefone">Telefone/WhatsApp</label>
                            <input type="text" id="txtTelefone" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="txtDataNascimento">Data de Nascimento</label>
                            <input type="text" id="txtDataNascimento" class="form-control" value="">
                        </div>                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-success"><i class="fas fa-key mr-1"></i> <?=_('Alterar minha senha');?></button>
                        <button type="button" class="btn btn-primary float-right"><i class="fas fa-save mr-1"></i> <?=_('Salvar');?></button>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?= _('Licenças'); ?></h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?= _('Indicativo'); ?></th>
                                    <th><?= _('Tipo'); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PY3RCP</td>
                                    <td>Classe A</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PP3PEL</td>
                                    <td>Especial</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PX3P3030</td>
                                    <td>PX</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> <?=_('Adicionar');?></button>
                    </div>                    
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.card -->
</div>

<?= view('elements/footer.php'); ?>