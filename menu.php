<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(180deg, rgba(29,30,32,1) 69%, rgba(42,22,22,1) 84%, rgba(0,0,0,1) 100%);">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="dist/img/dnw.jpg" alt="DNW Platform" class="brand-image elevation-3">
    <span class="brand-text font-weight-light">DNW Platform <sup>KH</sup></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/photo_2023-09-04_19-14-26.jpg" width="40px" class="img-circle" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Natdanai bunsaram</a>
      </div>
    </div> -->
    <!-- <a href="index.php" class="brand-link">
      <img src="dist/img/keo.jpg" alt="DNW Platform" width="40" class="elevation-1">
      <span class="brand-text font-weight-light"> Natdanai bunsaram</span>
    </a> -->
    <!-- <div class="row no-gutters">
        <div class="col-md-4">
          <img src="dist/img/keo.jpg" alt="DNW Platform" width="80px">
        </div>
        <div class="col-md-8">
            <p class="card-text">Natdanai bunsaram</p>
            <p class="card-text"><small class="text-muted">0004034</small></p>
        </div>
      </div> -->
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="index.php" class="nav-link <?php if ($menu == "index") {
                                                echo "active";
                                              } ?> ">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>ซื้อสินค้า</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="order.php" class="nav-link <?php if ($menu == "order") {
                                                echo "active";
                                              } ?> ">
            <i class="nav-icon fas fa-history"></i>
            <p>ประวัติการซื้อ</p>
          </a>
        </li>


        <li class="nav-header">บัญชีของฉัน</li>
        <li class="nav-item">
          <a href="profile.php" class="nav-link <?php if ($menu == "profile") {
                                                  echo "active";
                                                } ?> ">
            <i class="nav-icon fas fa-edit"></i>
            <p>จัดการบัญชี</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="nav-icon fas fa-power-off text-danger"></i>
            <p class="text">ออกจากระบบ</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>