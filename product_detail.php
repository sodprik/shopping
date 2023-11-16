<?php
session_start();
require_once('condb.php');

if (!isset($_SESSION['user_login'])) {
  header("Location: login.php");
  exit();
}

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit();
}

$p_id = $_GET['id'];

// ดึงข้อมูลของสินค้าที่มี p_id ตรงกับที่ถูกส่งมา
$stmt = $conn->prepare("SELECT * FROM product WHERE p_id = ?");
$stmt->execute([$p_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
  // หากไม่พบสินค้าที่ตรงกับ p_id ที่ระบุให้ redirect ไปที่หน้า index.php
  header("Location: index.php");
  exit();
}
$p_code = $product['p_code'];
$p_img = $product['p_img'];
$p_name = $product['p_name'];
$p_price = ($row['position'] == 'DN') ? $product['p_price_dn'] : $product['p_price_da'];
$p_detail = $product['p_detail'];
$p_detail2 = $product['p_detail2'];
?>

<!DOCTYPE html>
<html lang="en">
<?php $menu = "product_detail"; ?>
<?php include("head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include("navbar.php"); ?>
    <!-- /.navbar -->
    <?php include("menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Product Detail</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Product Detail</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <section>
        <div class="container px-4 px-lg-5">
          <div class="row gx-4 gx-lg-5 align-items-left">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="p_img/<?php echo $p_img; ?>" alt="..."></div>
            <div class="col-md-6">
              <div class="small mb-1"><?php echo $p_code; ?></div>
              <h1 class="display-5 fw-bolder"><?php echo $p_name; ?></h1>
              <div class="fs-5 mb-5">
                <h2 class="text-decoration-line-through">$ <?php echo $p_price; ?></h2>
                <div class="d-flex pt-3">
                  <input class="form-control text-center me-3 mr-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem">
                  <a href="order_p.php?id=<?php echo $p_id; ?>" class="btn btn-outline-danger flex-shrink-0">
                    <i class="fas fa-shopping-basket"></i>
                    Add to cart
                  </a>
                </div>
              </div>
              <div class="d-flex">
                <?php echo $p_detail; ?><br>
              </div>

            </div>
          </div>
          <hr>
          <div class="d-flex text-left">
            <?php echo $p_detail2; ?>
          </div>
        </div>
      </section>

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("footer.php"); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <?php include("script.php"); ?>
</body>

</html>