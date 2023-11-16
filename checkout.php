<?php
session_start();
require_once 'condb.php';

if (!isset($_SESSION['user_login'])) {
  header("Location: login.php");
  exit();
}

$userID = $_SESSION['user_login'];
// นำข้อมูลนี้ไปใช้ในการดึงข้อมูลผู้ใช้จากฐานข้อมูล
// ทำการ query และดึงข้อมูลผู้ใช้จากฐานข้อมูล
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = :userID");
$stmt->bindParam(':userID', $userID);
$stmt->execute();
$user = $stmt->fetch();
// แสดงข้อมูลผู้ใช้ในหน้า Checkout

?>
<!DOCTYPE html>
<html lang="en">
<?php $menu = "index"; ?>
<?php include "head.php"; ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php include "navbar.php"; ?>
    <?php include "menu.php"; ?>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5 class="m-0 text-dark">Checkout</h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="cart.php">Cart</a></li>
                <li class="breadcrumb-item active">Checkout</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title" style="line-height: 2.1rem"><i class="far fa-address-book"></i> ข้อมูลผู้สั่งซื้อ</h3>
                </div>
                <div class="card-body px-5">
                  <div class="row mb-3">
                    <p class="col-xl-1 text-muted">รหัสสมาชิก :</p>
                    <div class="col-xl-9">
                      <p><? echo $user['user'] ?></p>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <p class="col-xl-1 text-muted">ชื่อผู้สั่งซื้อ :</p>
                    <div class="col-xl-9">
                      <p><? echo $user['firstname'] ?> <? echo $user['lastname'] ?></p>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <p class="col-xl-1 text-muted">เบอร์โทรศัพท์ :</p>
                    <div class="col-xl-9">
                      <p><? echo $user['phone'] ?></p>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <p class="col-xl-1 text-muted">การจัดส่ง :</p>
                    <div class="col-xl-9">
                      <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-primary active">
                          <input type="radio" name="options" id="option1" checked> รับที่บริษัท
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title" style="line-height: 2.1rem">
                    <i class="fas fa-cart-arrow-down"></i> รายการสินค้าที่สั่งซื้อ
                  </h3>
                </div>
                <div class="card-body">
                  <table class="table table-hover" id="tb1">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col" class="text-left">Name</th>
                        <th scope="col" class="sorting_disabled align-middle text-md-right">Price</th>
                        <th scope="col" class="sorting_disabled align-middle text-md-right">Qty</th>
                        <th scope="col" class="sorting_disabled align-middle text-md-right">Total</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <?php
                      if (isset($_SESSION["intLine"])) {
                        $totalPrice = 0;
                        $totalQty = 0; // Initialize total quantity

                        try {
                          $itemCount = 0; // Initialize item count

                          for ($i = 0; $i <= $_SESSION["intLine"]; $i++) {
                            if ($_SESSION["strProductID"][$i] != "") {
                              $productID = $_SESSION["strProductID"][$i];
                              $stmt = $conn->prepare("SELECT * FROM product WHERE p_id = :p_id");
                              $stmt->bindParam(':p_id', $productID);
                              $stmt->execute();
                              $product = $stmt->fetch();

                              if ($product) {
                                $productId = $product['p_id'];
                                $productName = $product['p_name'];
                                $productPrice = $product['p_price'];
                                $p_price = ($user['position'] == 'DN') ? $product['p_price_dn'] : (($user['position'] == 'DA') ? $product['p_price_da'] : $product['p_price']);
                                $productImg = $product['p_img'];
                                $quantity = $_SESSION["strQty"][$i];
                                $total = $p_price * $quantity;
                                $totalPrice += $total;
                                $totalQty += $quantity; // Accumulate total quantity
                      ?>
                                <tr>
                                  <th scope="row"><?php echo ++$itemCount; ?></th>
                                  <td class="text-left"><img class="mr-2" src="p_img/<?php echo $productImg; ?>" width="50px"><?php echo $productName; ?></td>
                                  <td class="sorting_disabled align-middle text-md-right"><?php echo $p_price; ?></td>
                                  <td class="sorting_disabled align-middle text-md-right"><?php echo $quantity; ?></td>
                                  <td class="sorting_disabled align-middle text-md-right"><?php echo $total; ?></td>
                                </tr>
                      <?php
                              }
                            }
                          }
                        } catch (PDOException $e) {
                          echo "Error: " . $e->getMessage();
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                  <div class="row justify-content-end">
                    <div class="col-md-6 col-lg-5 col-xl- text-right">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            <tr>
                              <th>รวมเป็นเงิน</th>
                              <td>$ <?php echo $totalPrice; ?></td>
                            </tr>
                            <tr>
                              <?php
                              // Fetch shipping cost from the database
                              $stmt = $conn->prepare("SELECT cost FROM ShippingCosts WHERE shipping_type = 'Standard'");
                              $stmt->execute();
                              $shippingCost = $stmt->fetchColumn();
                              ?>
                              <th>ค่าขนส่ง</th>
                              <td>$ <?php echo number_format($shippingCost, 2); ?></td>
                            </tr>
                            <tr>
                              <?php
                              $stmt = $conn->prepare("SELECT cost FROM ShippingCosts WHERE shipping_type = 'Standard'");
                              $stmt->execute();
                              $shippingCost = $stmt->fetchColumn();

                              // คำนวณราคารวมทั้งหมด โดยรวมกับค่าขนส่ง
                              $totalPriceWithShipping = $totalPrice + $shippingCost;
                              ?>
                              <th>จำนวนเงินรวมทั้งสิ้น</th>
                              <td>$ <?php echo $totalPriceWithShipping; ?> </td>
                              <?php
                              // หลังจากคำนวณค่า $totalPriceWithShipping แล้ว
                              $_SESSION['totalPriceWithShipping'] = $totalPriceWithShipping; // เก็บค่า totalPriceWithShipping ไว้ใน session
                              ?>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="payment.php" class="btn btn-outline-primary float-right ml-2">ยืนยันการสั่งซื้อ</a>
                  <a href="cart.php" class="btn btn-outline-secondary float-right">ย้อนกลับ</a>
                  <? echo $_SESSION['totalPriceWithShipping']; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include "footer.php"; ?>
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
  </div>

  <?php include "script.php"; ?>
</body>

</html>