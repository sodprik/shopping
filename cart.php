<?php
session_start();
require_once 'condb.php';

if (!isset($_SESSION['user_login'])) {
  header("Location: login.php");
  exit();
}

// Check if the action is set and is for deleting the product
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['pid'])) {
  $productIDToDelete = $_GET['pid'];

  // Find the product in the cart and update the quantity
  foreach ($_SESSION["strProductID"] as $key => $productID) {
    if ($productID == $productIDToDelete) {
      // Remove the product from the cart
      $_SESSION["strProductID"][$key] = '';
      $_SESSION["strQty"][$key] = 0;
    }
  }

  // Update the quantity after removing the product
  $_SESSION['cartItemCount'] = count(array_filter($_SESSION["strQty"], function ($val) {
    return $val > 0;
  }));

  header("Location: cart.php");
  exit();
}
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
              <h5 class="m-0 text-dark">Cart</h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Cart</li>
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
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <?php
                      $userID = $_SESSION['user_login'];
                      $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = :userID");
                      $stmt->bindParam(':userID', $userID);
                      $stmt->execute();
                      $user = $stmt->fetch();

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
                                  <td><?php echo $p_price; ?></td>
                                  <td><?php echo $quantity; ?></td>
                                  <td><?php echo $total; ?></td>
                                  <td>
                                    <a href="order_p.php?id=<?php echo $productId; ?>" class="btn btn-outline-primary">+</a>
                                    <?php if ($_SESSION["strQty"][$i] > 1) { ?>
                                      <a href="order_del.php?id=<?php echo $productId; ?>" class="btn btn-outline-primary">-</a>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <a href="cart.php?action=delete&pid=<?php echo $productId; ?>" class="btn btn-danger">
                                      <i class="fas fa-trash-alt"></i>
                                    </a>
                                  </td>
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
                  <div style="text-align:right">
                    <button type="button" class="btn btn-dark p-2 mr-3">สินค้าทั้งหมด : <?php echo $totalQty; ?> ชิ้น</button>
                    <button type="button" class="btn btn-dark p-2 mr-3">Total : $ <?php echo $totalPrice; ?></button>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="checkout.php" class="btn btn-outline-primary float-right ml-2">ยืนยันการสั่งซื้อ</a>
                  <a href="index.php" class="btn btn-outline-secondary float-right">เลือกสินค้า</a>
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