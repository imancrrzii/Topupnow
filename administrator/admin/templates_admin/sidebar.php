<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">


          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <div class="d-sm-none d-lg-inline-block">Administratorrr
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a data-toggle="modal" data-target="#exampleModal" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>

            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">TopupNow</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html"></a>
          </div>
          <ul class="sidebar-menu">
            <li><a class="nav-link" href="<?php echo base_url ?>administrator/index.php"><i
                  class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
            </li>
            <li><a class="nav-link" href="<?php echo base_url ?>administrator/admin/manageAdmin.php"><i
                  class="fas fa-user-cog"></i> <span>Data Admin</span></a>
            </li>
            <li><a class="nav-link" href="<?php echo base_url ?>administrator/kategori/manageCategory.php"><i
                  class="fas fa-grip-horizontal"></i> <span>Data Kategori</span></a>
            </li>
            <li><a class="nav-link" href="<?php echo base_url ?>administrator/item/manageItem.php"><i
                  class="fas fa-clipboard-list"></i>
                <span>Data Item</span></a>
            </li>
            <li><a class="nav-link" href="<?php echo base_url ?>administrator/transaksi/manageOrder.php"><i
                  class="fas fa-shopping-cart"></i> <span>Data Transaksi</span></a>
            </li>
            <li><a class="nav-link" href="<?php echo base_url ?>administrator/kontak/manageContact.php"><i
                  class="fas fa-id-card"></i> <span>Data Kontak</span></a>
            </li>
          </ul>
        </aside>
      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Apakah anda yakin ingin keluar?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              <a type="button" class="btn btn-success" href="<?= base_url ?>administrator/login.php">logout</a>
            </div>
          </div>
        </div>
      </div>