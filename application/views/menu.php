<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url('public/login/images/logo.png')?>" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-size: 1.60rem;">Carnetización</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- <i class="fas fa-user-tie" style="color:aliceblue; width: 30px;">  </i>  -->
                <i class='fa fa-user-circle' style="color:aliceblue; width: 250px;"> <?php print $usua->nom_usu; ?></i>
            </div>

        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?= base_url('Trabajadores')?>" class="nav-link">
                    <i class='fa fa-users'></i>
                        <p>
                            Trabajadores
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
   
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    
                    <i class='fa fa-address-card'></i>
                        <p>
                            Carnet Emitidos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                   
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class='fas fa-file-invoice'></i>
                        <p>
                            REPORTES
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                   
                </li>
                <?php if ($usua->id_tip_usu == 1){?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            CONFIGURACION
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                            <a href="<?= base_url('Usuarios')?>" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                     
                  

                    </ul>
                </li>
                <?php }?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
