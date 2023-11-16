<?php
session_start();
require_once('condb.php');

if (!isset($_SESSION['user_login'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php $menu = "index"; ?>
<?php include("head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php include("navbar.php"); ?>
    <?php include("menu.php"); ?>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Product</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left">

          <?php
          $stmt = $conn->prepare("SELECT * FROM product");
          $stmt->execute();
          $products = $stmt->fetchAll();

          $userID = $_SESSION['user_login'];
          $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = :userID");
          $stmt->bindParam(':userID', $userID);
          $stmt->execute();
          $user = $stmt->fetch();

          foreach ($products as $product) {
            $p_id = $product['p_id'];
            $p_img = $product['p_img'];
            $p_name = $product['p_name'];
            $p_price = ($user['position'] == 'DN') ? $product['p_price_dn'] : (($user['position'] == 'DA') ? $product['p_price_da'] : $product['p_price']);
          ?>
            <div class="col mb-5">
              <a href="product_detail.php?id=<?php echo $p_id; ?>">
                <div class="card h-100">
                  <?php
                  // ตัวแปร position จำลองค่า position ที่มาจากข้อมูลฐานข้อมูลหรือจากที่อื่น
                  $position = $user['position']; // สมมติว่า position เป็น 'DN', 'DA' หรือ 'user'

                  // ตัวแปรเพื่อเก็บข้อความและเลือกสีตามเงื่อนไข position
                  if ($position == 'DN') {
                    $saleText = 'Sale 23%';
                    $badgeClass = 'bg-info'; // สีของ badge เมื่อ position เป็น 'DN'
                  } elseif ($position == 'DA') {
                    $saleText = 'Sale 50%';
                    $badgeClass = 'bg-danger'; // สีของ badge เมื่อ position เป็น 'DA'
                  } elseif ($position == 'user') {
                    $saleText = 'Custom Sale'; // สร้างข้อความที่ต้องการในกรณี position เป็น 'user'
                    $badgeClass = 'bg-warning'; // สีของ badge เมื่อ position เป็น 'user'
                  } else {
                    // ตำแหน่งที่ไม่ระบุ
                    $saleText = '';
                    $badgeClass = '';
                  }
                  ?>
                  <div class="badge <?php echo $badgeClass; ?> text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                    <?php echo $saleText; ?>
                  </div>
                  <img class="card-img-top" src="p_img/<?php echo $p_img; ?>" alt="...">
              </a>
              <div class="card-body">
                <div class="text-center">
                  <h5 class="text-bold"><?php echo $p_name; ?></h5>
                  <h4>$ <?php echo $p_price; ?></h4>
                </div>
              </div>
              <div class="card-footer pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                  <a class="btn btn-outline-danger mt-auto mr-2" href="order_p.php?id=<?php echo $p_id; ?>"><i class="fas fa-shopping-basket mi-24"></i></a>
                  <a class="btn btn-outline-dark mt-auto" href="product_detail.php?id=<?php echo $p_id; ?>"><i class="fas fa-file-alt mi-24"></i></a>
                </div>
              </div>
            </div>
        </div>
      <?php
          }
      ?>
      </div>
    </div>
  </div>
  <?php include("footer.php"); ?>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
  <?php include("script.php"); ?>
</body>

</html>