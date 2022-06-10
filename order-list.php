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
   <title>Trang chủ</title>
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
   <style>
   a:hover
   {
    color: #004B89;
   }
   
   </style>
</head>

<body>
   <div class="wrap">
      <?php require_once 'view/header.php' ?>
      <div class="container-fluid my-5 px-5">
          <h3>Xin chào, <?php echo $_SESSION['Fullname']; ?></h3>
          <p>Bạn đang đăng nhập với <?php echo $_SESSION['Email'] ?></p>
          
		  <h3 class="my-4">Đơn đặt hàng của bạn</h3>
		  <div class="container-fluid">
            <div class="row">
                <div class="col col-2"><h5>ID</h5></div>
                <div class="col col-3"><h5>Ngày đặt</h5></div>
                <div class="col col-2"><h5>Tổng tiền</h5></div>
                <div class="col col-3"><h5>Tình trạng</h5></div>
                <div class="col col-2"><h5>Detail</h5></div>
            </div>
            <hr>
          <?php 
          $classorder = new order();
          $orderarray = $classorder->getAllOrder($_SESSION['ID'],$conn);
          for($i=0;$i<sizeof($orderarray);$i++)
          {
          ?>
            <div class="row">
                <div class="col col-2"><p><?php echo $i+1?></p></div>
                <div class="col col-3"><p><?php echo $classaccount->converttimedate($orderarray[$i]['Orderdate'])?></p></div>
                <div class="col col-2"><p><?php echo number_format($orderarray[$i]['Total'])?>đ</p></div>  
                <div class="col col-3">
                    <?php if($orderarray[$i]['State']==0)
                    { ?>
                        <button class="btn btn-danger">Chưa xác nhận</button> <?php } ?>
                    <?php if($orderarray[$i]['State']==1)
                    { ?>
                        <button class="btn btn-success">Đã xác nhận</button> <?php } ?>
                </div>
                <div class="col col-2">
                    <a href="order-detail.php?order-id=<?php echo $orderarray[$i]['ID'] ?>" class="btn btn-primary">Detail</a>
                </div>  
            </div>
            <hr>
          <?php } ?>
          </div>
            <h3 class="my-4">Sản phẩm đã xem</h3>
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
            <h5 class="py-5 my-2">Lịch sử trống</h5>
          <?php } ?>
		  </div>
      </div>
      <?php require_once 'view/footer.php' ?>
   </div>	
   <script src="assets/js/app.js"></script>
</body>


</html>