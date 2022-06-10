<!DOCTYPE html>
<html lang="en">
<?php
require_once("controller/authController.php");
require_once("class/category.php");
require_once("class/product.php");
require_once("class/cart.php");
require_once("class/order.php");
?>
<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Giỏ hàng</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <link rel="icon"
      href="https://m.media-amazon.com/images/G/01/Zappos/MysteryDeals2021/2021-ZAPPOS-HOLIDAY-HEADER-LOGO.svg"
      type="image/x-icon" />
   <link rel="stylesheet" href="assets/fonts/fontawesome-free-5.15.4-web/css/all.css" />
   <link rel="stylesheet" href="assets/fonts/icons-1.5.0/font/bootstrap-icons.css" />
   <link rel="stylesheet" href="assets/css/grid.css" />
   <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
   <div class="wrap">
      <?php require_once 'view/header.php' ?>
      <div class="content-card">
         <div class="wrap-cart-list">
            <h2 class="my-4">Danh sách sản phẩm</h2>
            <div class="container my-4">
            <div class="row">
                <hr>
                <div class="col col-9">
                <?php 
                if(isset($_SESSION['cart']))
                {
                $cartsize = sizeof($_SESSION['cart']);
                for($i=0;$i<$cartsize;$i++)
			    {
                ?>
                    <div class="row">
                        <div class="col col-3">
                            <img src="<?php echo $_SESSION['cart'][$i]['Image']?>" alt="Sản phẩm" height="180" width="180">
                        </div>
                        <div class="col col-5">
                        <form method="post">
                            <input type="text" value="<?php echo $i ?>" name="removeid" hidden>
                            <b><?php echo $_SESSION['cart'][$i]['Name']?></b>
                            <p>Thương hiệu: <?php echo $_SESSION['cart'][$i]['Brand']?><br>
                            Size: <?php echo $_SESSION['cart'][$i]['Size']?></p>
                            <button type="submit" class="btn btn-danger" name="remove-cart-btn">Xóa</button>
                        </form>
                        </div>
                        <div class="col col-4">
                            <br><br>
                            <b><?php echo number_format($_SESSION['cart'][$i]['Price']*$_SESSION['cart'][$i]['Quantity']);?>đ</b>
                        </div>
                    </div>
                    <hr>
                <?php 
                   }
                } 
                ?>
                </div>
                <?php if(!isset($_SESSION['cart'])) 
                { ?>
                <div class="row">
                    <div class="col col-12">
                        <img src="assets/img/background/empty-cart.png" class="img-fluid mx-auto d-block" style="height:30px, width: 30px">                       
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col col-3"></div>
                    <div class="col col-6"><a href="index.php" class="btn btn-dark w-100 py-3 pt-200">Tiếp tục mua hàng</a></div>
                    <div class="col col-3"></div>
                </div>
                <?php } ?>
                <?php if(isset($_SESSION['cart']))
                { ?>
                <div class="col col-3">
                <?php
                $total=0;
                for($i=0;$i<$cartsize;$i++)
			    {
                    $s=$_SESSION['cart'][$i]['Price']*$_SESSION['cart'][$i]['Quantity'];
                    $total=$total + $s;
                }
                ?>
                    <div class="row">
                        <div class="col col-8"><b>Thành tiền:</b></div>
                        <div class="col col-4"><h4><?php echo number_format($total) ?></h4></div>
                    </div>

                    <hr>
                    <a href="thanh-toan.php" class="btn btn-dark w-100 py-3">Thanh toán</a>
                    <a href="index.php" class="btn w-100 py-3 my-2 border border-dark border-2">Tiếp tục mua hàng</a>
                </div>
                <?php } ?>
            </div>
            </div>            
         </div>
         <div class="Recently-viewed-items grid wide">
            <h1 class="my-4">Sản phẩm đã xem</h1>
            <div class="row">       
		      <?php if(isset($_SESSION['History']))
              {
                $classproduct = new product();
                $count=0;
                for($i=sizeof($_SESSION['History'])-1;$i>=0;$i--)
                {
                $count++;
                if($count<6)
                {
                $idhistory = $_SESSION['History'][$i]['ID'];
                $productarrayhistory = $classproduct->getByID($conn, $idhistory);
                $detailproductarrayhistory = $classproduct->getAllDetail($conn, $idhistory);
                ?>
                 <div class=" col l-2-4">
                    <a href="product-detail.php?product-id=<?php echo $productarrayhistory['ID'] ?>" class="product-item">
                       <div class="wrap-img">
                          <img src="<?php echo $detailproductarrayhistory['Image1']?>" alt="Product Image" class="product-img">
                       </div>
                       <div class="product-like">
                          <i class="far fa-heart"></i> <span><?php echo  number_format($classproduct->getRating($conn, $productarrayhistory['ID']),1) ?></span>
                       </div>
                       <div class="product-content">
                          <div class="product-name"><?php echo $productarrayhistory['Name'];?></div>
                          <div class="product-brand"><?php echo $detailproductarrayhistory['Brand'];?></div>
                          <div class="price">
                             <small><?php echo $productarrayhistory['Sold']?> sản phẩm đã bán</small>
                             <span class="product-price-sale"><?php echo number_format($productarrayhistory['Price']);?>đ</span>
                          </div>
                       </div>
                    </a>
                 </div>   
              <?php }} } 
              else {?>
                <h5>Chưa có lịch sử</h5>
              <?php } ?>
		      </div>
         </div>
      </div>

      <?php require_once 'view/footer.php' ?>
   </div>
   <script src="assets/js/app.js"></script>
</body>

</html>


<!-- MailerPHP -->