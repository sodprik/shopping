<?php
session_start();
require_once 'condb.php';

// ตรวจสอบสถานะการเข้าสู่ระบบของผู้ใช้
if (!isset($_SESSION['user_login'])) {
  header("Location: login.php");
  exit();
}

// เช็คการทำงานในการลบสินค้า
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['pid'])) {
  $productIDToDelete = $_GET['pid'];

  // ค้นหาและลบสินค้าออกจากตะกร้า
  foreach ($_SESSION["strProductID"] as $key => $productID) {
    if ($productID == $productIDToDelete) {
      $_SESSION["strProductID"][$key] = '';
      $_SESSION["strQty"][$key] = '';
    }
  }

  // อัพเดตจำนวนสินค้าใน Navbar โดยนับจำนวนสินค้าใน Session ใหม่
  $cartItemCount = count(array_filter($_SESSION["strProductID"], function ($val) {
    return $val !== '';
  }));

  header("Location: cart.php");
  exit();
}
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background: linear-gradient(to right, #dc3545, #f1c7c7);">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars fa-2x text-white"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index.php" class="nav-link text-white">Home</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <?php

    // คำนวณราคารวมของสินค้าทั้งหมด
    $totalPrice = 0;
    foreach ($_SESSION["strProductID"] as $key => $product) {
      if ($product !== '') {
        $stmt = $conn->prepare("SELECT * FROM product WHERE p_id = :p_id");
        $stmt->bindParam(':p_id', $product);
        $stmt->execute();
        $productDetails = $stmt->fetch();

        $productPrice = $productDetails['p_price'];
        $quantity = $_SESSION["strQty"][$key];
        $total = $productPrice * $quantity;
        $totalPrice += $total;
        $totalQty += $quantity;
      }
    }
    ?>
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="fas fa-shopping-cart"></i>
        <span class="badge badge-danger navbar-badge" style="background-color: #ca0000;"><?php echo $totalQty; ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
        <span class="dropdown-item dropdown-header">สินค้าในตะกร้าของคุณ</span>
        <div class="dropdown-divider"></div>
        <!-- เริ่มต้นการวนลูปแสดงสินค้าในตะกร้า -->
        <?php
        foreach ($_SESSION["strProductID"] as $key => $product) {
          if ($product !== '') {
            $stmt = $conn->prepare("SELECT * FROM product WHERE p_id = :p_id");
            $stmt->bindParam(':p_id', $product);
            $stmt->execute();
            $productDetails = $stmt->fetch();

            $productPrice = $productDetails['p_price'];
            $quantity = $_SESSION["strQty"][$key];
            $total = $productPrice * $quantity;

        ?>
            <div class="dropdown-item">
              <img class="" src="p_img/<?php echo $productDetails['p_img']; ?>" width="30px" alt="...">
              <?php echo $productDetails['p_name']; ?>
              <span class="float-right text-muted text-sm">$<?php echo $total; ?> x <?php echo $quantity; ?><a href="navbar.php?action=delete&pid=<?php echo $product; ?>"><i class="fas fa-trash-alt ml-2"></i></a></span>
            </div>
            <div class="dropdown-divider"></div>
        <?php
          }
        }
        ?>
        <!-- สิ้นสุดการวนลูปแสดงสินค้า -->
        <a href="cart.php" class="dropdown-item dropdown-footer">See All Cart</a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="fas fa-bell"></i>
        <span class="badge badge-danger navbar-badge" style="background-color: #ca0000;">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="img-profile rounded-circle" src="dist/img/photo_2023-09-04_19-14-26.jpg" width="30px">
      </a>
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in mr-2" aria-labelledby="userDropdown">
        <h6 class="dropdown-header d-flex align-items-center">
          <img class="img-profile rounded-circle" src="dist/img/photo_2023-09-04_19-14-26.jpg" width="50px">
          <div class="dropdown-user-details">
            <div class="text-left mr-2 ml-2">Natdanai bunsaram</div>
            <div class="text-left ml-2">0004034</div>
          </div>
        </h6>
        <a class="dropdown-item" href="profile.php">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profile
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>