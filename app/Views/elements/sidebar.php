<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://g.page/r/CevSowL-LFDtEAI"  target="_blank" class="nav-link">Google</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="http://radioclubedepelotas.blogspot.com/" target="_blank" class="nav-link">Blog</a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url();?>" class="brand-link text-center">
      <span class="brand-text font-weight-light"><?=rcTitle();?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image mt-1">
          <i class="fa fa-user" style="color:#c2c7d0"></i>
        </div>
        <div class="info">
          <a href="<?=base_url('atualizar-dados');?>" class="d-block"><?=session()->get()['nome'];?></a>
        </div>
      </div>
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="min-height:800px">

          <li class="nav-item">
            <a href="<?=base_url();?>" class="nav-link <?=uri_string()=='/'?'active':null;?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                <?=_('Painel do associado');?>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('sair');?>" class="nav-link <?=uri_string()=='/sair'?'active':null;?>">
            <i class="nav-icon fas fa-solid fa-unlock"></i>
              <p>
                <?=_('Sair do sistema');?>
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>