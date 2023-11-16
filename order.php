<!DOCTYPE html>
<html lang="en">
<?php $menu = "order"; ?>
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
                            <h5 class="m-0 text-dark">Order</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Order</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title" style="line-height: 2.1rem"><i class="fas fa-history"></i> ประวัติการสั่งซื้อ</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover" id="example1">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">สถานะ</th>
                                                <th scope="col">รหัสสั่งซื้อ</th>
                                                <th scope="col">ชื่อผู้ซื้อ</th>
                                                <th scope="col">ราคารวม($)</th>
                                                <th scope="col">วันที่สั่งซื้อ</th>
                                                <th scope="col">จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <th scope="row"><span class="badge badge-success"> ชำระเงินแล้ว </span></th>
                                                <td><a href="order_detail.php" class="btn btn-outline-primary p-1 "> PO00001 </a></td>
                                                <td>Natdanai bunsaram</td>
                                                <td>$ 172.00</td>
                                                <td><span class="text-muted small"> 1 ชั่วโมงที่ผ่านมา <br> 10 พ.ค. 64 · 16:56 น.</span></td>
                                                <td><a href="order_detail.php" class="btn btn-info"><i class="fas fa-search"></i> ดูข้อมูล</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><span class="badge badge-success"> ชำระเงินแล้ว </span></th>
                                                <td><a href="order_detail.php" class="btn btn-outline-primary p-1 "> PO00002 </a></td>
                                                <td>Natdanai bunsaram</td>
                                                <td>$ 152.00</td>
                                                <td><span class="text-muted small"> 2 ชั่วโมงที่ผ่านมา <br> 10 พ.ค. 64 · 17:00 น.</span></td>
                                                <td><a href="order_detail.php" class="btn btn-info"><i class="fas fa-search"></i> ดูข้อมูล</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><span class="badge badge-success"> ชำระเงินแล้ว </span></th>
                                                <td><a href="order_detail.php" class="btn btn-outline-primary p-1 "> PO00003 </a></td>
                                                <td>Natdanai bunsaram</td>
                                                <td>$ 550.00</td>
                                                <td><span class="text-muted small"> 3 ชั่วโมงที่ผ่านมา <br> 10 พ.ค. 64 · 18:00 น.</span></td>
                                                <td><a href="order_detail.php" class="btn btn-info"><i class="fas fa-search"></i> ดูข้อมูล</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- <div style="text-align:right">
                    <!-- <a href="index.php"><button type="button" class="btn btn-outline-secondary">เลือกสินค้า</button></a> | -->
                                    <!-- <button type="submit" class="btn btn-outline-primary">ยืนยันการสั่งซื้อ</button> -->
                                    <!-- <a href="checkout.php"><button type="button" class="btn btn-outline-primary">ยืนยันการสั่งซื้อ</button></a> -->
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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