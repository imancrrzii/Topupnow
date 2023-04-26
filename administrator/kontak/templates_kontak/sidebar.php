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
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Pesan
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-desc">
                    <b>Iman Carrazi Syamsidi</b>
                    <p>Minal Aidin Wal Faizin</p>
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-desc">
                    <b>Anharul Zikri</b>
                    <p>Minal Aidin Wal Faizin</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-desc">
                    <b>Tasya Khadijah</b>
                    <p>Minal Aidin Wal Faizin</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-desc">
                    <b>Muhammad Nurhadi</b>
                    <p>Minal Aidin Wal Faizin</p>
                    <div class="time">16 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-desc">
                    <b>Aisyah Nur Khoirofiq</b>
                    <p>Minal Aidin Wal Faizin</p>
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">Selamat Lebaran
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <div class="d-sm-none d-lg-inline-block">Administrator
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="#" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="#" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="#" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
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
            <li class="menu-header">Dashboard</li>
            <li class="dropdown">
              <a href="<?= base_url ?>administrator/index.php" class="nav-link"><i
                  class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Manajemen</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                <span>Menu</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= base_url ?>administrator/admin/manageAdmin.php"><i
                      class="fas fa-user-cog"></i> <span>Administrator</span></a>
                </li>
                <li><a class="nav-link" href="<?= base_url ?>administrator/kategori/manageCategory.php"><i
                      class="fas fa-grip-horizontal"></i> <span>Kategori</span></a>
                </li>
                <li><a class="nav-link" href="<?= base_url ?>administrator/item/manageItem.php"><i
                      class="fas fa-clipboard-list"></i>
                    <span>Item</span></a>
                </li>
                <li><a class="nav-link" href="<?= base_url ?>administrator/transaksi/manageOrder.php"><i
                      class="fas fa-shopping-cart"></i> <span>Transaksi</span></a>
                </li>
                <li><a class="nav-link" href="<?= base_url ?>administrator/kontak/manageContact.php"><i
                      class="fas fa-id-card"></i> <span>Kontak</span></a>
                </li>
              </ul>
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
              <a type="button" class="btn btn-success" href="<?= base_url ?>administrator/login.php">Logout</a>
            </div>
          </div>
        </div>
      </div>