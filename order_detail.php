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
              <h1 class="m-0">Order Detail</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="order.php">Order</a></li>
                <li class="breadcrumb-item active">Order Detail</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card shadow">
                <div class="card-header border-0 pt-4">
                  <h4>
                    <i class="fas fa-cart-arrow-down"></i>
                    ข้อมูลใบสั่งซื้อ Order ID : PO00001
                  </h4>
                </div>
                <div class="card-body px-5">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="card shadow-sm">
                        <div class="card-header pt-4">
                          <h3 class="card-title">
                            <i class="fas fa-cart-arrow-down"></i>
                            ใบสั่งซื้อ
                          </h3>
                        </div>
                        <div class="card-body px-5">
                          <div class="row mb-3">
                            <p class="col-xl-3 text-muted">สถานะ :</p>
                            <div class="col-xl-9">
                              <span class="badge badge-success p-2"> ชำระเงินแล้ว</span>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <p class="col-xl-3 text-muted">Order ID :</p>
                            <div class="col-xl-9">
                              <p class="btn btn-outline-primary p-1"> PO00001 </p>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <p class="col-xl-3 text-muted">การจัดส่ง :</p>
                            <div class="col-xl-9">
                              <p class="btn btn-primary p-1 pr-3 pl-3"> รับที่บริษัท </p>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <p class="col-xl-3 text-muted">สั่งซื้อเมื่อ :</p>
                            <div class="col-xl-9">
                              <span class="text-muted small"> 1 ชั่วโมงที่ผ่านมา <br> 10 พ.ค. 64 · 16:56 น.</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="card shadow-sm">
                        <div class="card-header pt-4">
                          <h3 class="card-title">
                            <i class="fas fa-cart-arrow-down"></i>
                            ผู้สั่งซื้อ
                          </h3>
                        </div>
                        <div class="card-body px-5">
                          <div class="row mb-3">
                            <p class="col-xl-3 text-muted">รหัสสมาชิก :</p>
                            <div class="col-xl-9">
                              <p class="btn btn-primary p-1 pr-3 pl-3"> 0004034 </p>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <p class="col-xl-3 text-muted">ชื่อผู้สั่งซื้อ :</p>
                            <div class="col-xl-9">
                              <p>Natdanai bunsaram</p>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <p class="col-xl-3 text-muted">เบอร์โทรศัพท์ :</p>
                            <div class="col-xl-9">
                              <p>0935079040</p>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <p class="col-xl-3 text-muted">ที่อยู่ :</p>
                            <div class="col-xl-9">
                              <p>622 ม.4 ต.บัวเชด อ.บัวเชด จ.สุรินทร์ 32230</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0 pt-4">
                  <h3 class="card-title">
                    <i class="fas fa-cart-arrow-down"></i>
                    รายการสินค้า
                  </h3>
                </div>
                <div class="card-body">
                  <div id="logs_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                      <div class="col-sm-12 col-md-6"></div>
                      <div class="col-sm-12 col-md-6"></div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <table id="tb1" class="table table-hover dataTable no-footer dtr-inline" width="100%" role="grid" style="width: 100%;">
                          <thead>
                            <tr role="row">
                              <th scope="col">รหัสสินค้า</th>
                              <th scope="col">ชื่อสินค้า</th>
                              <th scope="col" class=" align-middle text-md-right">ราคา($)</th>
                              <th scope="col" class=" align-middle text-md-right">จำนวน</th>
                              <th scope="col" class=" align-middle text-md-right">ราคารวม($)</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="odd">
                              <td><a href="#" target="_blank" class="btn btn-outline-primary p-1"> P001 </a></td>
                              <td><img class="mr-2" src="p_img/128617519920230225_135507.png" class="img-fluid" width="50px"> KOREGINS D </td>
                              <td class=" align-middle text-md-right">55.00</td>
                              <td class=" align-middle text-md-right">1</td>
                              <td class=" align-middle text-md-right"><span class="text-right">55.00</span></td>
                            </tr>
                            <tr class="even">
                              <td><a href="#" target="_blank" class="btn btn-outline-primary p-1"> P002 </a></td>
                              <td class=" align-middle"><img class="mr-2" src="p_img/199469902420230225_135554.png" class="img-fluid" width="50px"> ALERTIDE </td>
                              <td class=" align-middle text-md-right">57.00</td>
                              <td class=" align-middle text-md-right">1</td>
                              <td class=" align-middle text-md-right"><span class="text-right">57.00</span></td>
                            </tr>
                            <tr class="odd">
                              <td class="align-middle dtr-control" tabindex="0"><a href="#" target="_blank" class="btn btn-outline-primary p-1"> P003 </a></td>
                              <td class=" align-middle"><img class="mr-2" src="p_img/182434314020230225_142920.png" class="img-fluid" width="50px"> VIEWO </td>
                              <td class=" align-middle text-md-right">57.00</td>
                              <td class=" align-middle text-md-right">1</td>
                              <td class=" align-middle text-md-right"><span class="text-right">57.00</span></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 col-md-5"></div>
                      <div class="col-sm-12 col-md-7"></div>
                    </div>
                  </div>
                  <div class="row justify-content-end">
                    <div class="col-md-6 col-lg-5 col-xl- text-right">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            <tr>
                              <th>รวมเป็นเงิน</th>
                              <td>$ 169.00</td>
                            </tr>
                            <tr>
                              <th>ค่าขนส่งข้ามประเทศ</th>
                              <td>$ 3.00</td>
                            </tr>
                            <tr>
                              <th>จำนวนเงินรวมทั้งสิ้น</th>
                              <td>$ 172.00</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
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