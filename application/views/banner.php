

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

	<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url('public/Admin/dist/img/AdminLTELogo.png')?> " alt="AdminLTELogo" height="60" width="60">
  </div>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <img class="animation__shake" src="<?= base_url('public/login/images/1.png')?>" style=" width:100%;" >
    </nav>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url('Inicio') ?>" class="nav-link">Inicio</a>
        </li>
        
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
   <i class="fas fa-tools"></i>
        </a>
      </li>

      

        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('Auth/logout') ?>" role="button"> Cerrar Sesiòn
         <i class="fas fa-lock"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->



	
		