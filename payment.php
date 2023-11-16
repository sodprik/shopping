<?php
session_start();
require_once 'condb.php';

if (!isset($_SESSION['user_login'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_login'];
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = :userID");
$stmt->bindParam(':userID', $userID);
$stmt->execute();
$user = $stmt->fetch();

$totalPriceWithShipping = $_SESSION['totalPriceWithShipping'];

?>

<!DOCTYPE html>
<html lang="en">
<?php $menu = "index"; ?>
<?php include("head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include("navbar.php"); ?>
        <!-- /.navbar -->
        <?php include("menu.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Payment</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active"><a href="cart.php">Cart</a></li>
                                <li class="breadcrumb-item active"><a href="checkout.php">Checkout</a></li>
                                <li class="breadcrumb-item active">Payment</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-xl-6">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header border-0">
                                    <h3 class="card-title" style="line-height: 2.1rem"><i class="far fa-credit-card"></i> Payment Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <p class="col-xl-2 text-muted">Total Amount :</p>
                                        <div class="col-xl-10">
                                            <h1 style="line-height: 0.6;"><?php echo '$ ' . $totalPriceWithShipping; ?></h1>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <p class="col-xl-2 text-muted">Account Name :</p>
                                        <div class="col-xl-10">
                                            <h5>NATTHAPHONG BUNSARAM</h5>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <p class="col-xl-2 text-muted">QR CODE :</p>
                                        <div class="col-xl-10">
                                            <img class="img-fluid" src="p_img/qrcode.png" width="250px" alt="QR Code">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <p class="col-xl-2 text-muted">Upload File :</p>
                                        <div class="col-xl-10">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">Account Details</div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <p class="col text-muted">รหัสสมาชิก :</p>
                                        <div class="col-xl-9">
                                            <p><? echo $user['user'] ?></p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <p class="col text-muted">ชื่อผู้สั่งซื้อ :</p>
                                        <div class="col-xl-9">
                                            <p><? echo $user['firstname'] ?> <? echo $user['lastname'] ?></p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <p class="col text-muted">เบอร์โทรศัพท์ :</p>
                                        <div class="col-xl-9">
                                            <p><? echo $user['phone'] ?></p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <p class="col text-muted">การจัดส่ง :</p>
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
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title" style="line-height: 2.1rem"><i class="fas fa-cart-arrow-down"></i> Ordered Products</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">#</th>
                                                <th scope="col" class="text-left">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Total</th>
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
                                                            <td>$ <?php echo $totalPriceWithShipping; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-outline-primary float-right ml-2">Proceed to Payment</a>
                                    <a href="checkout.php" class="btn btn-outline-secondary float-right">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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