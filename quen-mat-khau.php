<?php 
require_once("controller/authController.php");
require_once("class/category.php");
require_once("class/product.php");
require_once("class/cart.php");
require_once("class/order.php");
?>

<!doctype html>
<html>

<head>
   <meta charset="utf-8">
   <title>Quên Mật Khẩu</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon"
      href="https://m.media-amazon.com/images/G/01/Zappos/MysteryDeals2021/2021-ZAPPOS-HOLIDAY-HEADER-LOGO.svg"
      type="image/x-icon" />
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="css/maincss.css">
   <link rel="stylesheet" href="assets/fonts/fontawesome-free-5.15.4-web/css/all.css" />
   <link rel="stylesheet" href="assets/fonts/icons-1.5.0/font/bootstrap-icons.css" />
   <link rel="stylesheet" href="assets/css/grid.css" />
   <link rel="stylesheet" href="assets/css/style.css" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
   <div class="wrapper">
      <?php require_once 'view/header-account.php' ?>
      <div class="view" style="height: 80vh">
         <div class="container w-50 py-5">
            <div class="card">
               <div class="card-header text-center">
                  <h2>Quên Mật Khẩu</h2>
               </div>
               <div class="card-body">
                  <form action="quen-mat-khau.php" method="post">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-sm-12">
                              <label for="email">Hãy Nhập Địa Chỉ Email Của Bạn</label>
                              <input type="email" name="email" class="form-control" id="email"
                                 aria-describedby="emailHelp">
                              <small style="color:red"><?php echo $error?></small>
                           </div>
                           <div class="col-sm-12 py-2">
                              <small id="emailHelp" class="form-text text-muted">Chúng tôi sẽ không chia sẻ thông tin
                                 của bạn cho bất kì ai</small>
                           </div>
                        </div>
                     </div>
                     <button type="submit" name="password-reset-btn" class="btn btn-primary px-4">Gửi</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <?php require_once 'view/footer.php' ?>
   </div>
</body>

</html>