<?php include 'condb.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php include 'menu.php'; ?>
<div class="container text-center">
<br><br>
  <div class="row">
    <?php 
    $sql ="SELECT * FROM product ORDER BY p_id";
    $result = mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result )){
    ?>

    <div class="col-sm-3">
    <div class="text-center">
    <img src="p_img/<?=$row['p_img']?>" width="200px" height="200px" class="mt-5 p-2 my-2 border"> <br>
    ID : <?=$row['p_id']?> <br>
    <h5 class="text-success"><?=$row['p_name']?></h5>
    ราคา <b class="text-danger"><?=$row['p_price']?></b> $<br>
    <a class="btn btn-outline-success mt-3" href="product_detail.php?id=<?=$row['p_id']?>" > รายละเอียด</a>
    </div>
    <br>
    </div>
   <?php  
   }
   mysqli_close($conn);
   ?>

  </div>
</div>

    
</body>
</html>