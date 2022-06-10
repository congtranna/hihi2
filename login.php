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
   <title>Đăng nhập</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
      <div class="view2">
         <div class="container-fluid py-5">
            <div class="row" style="padding: 0">
               <div class="col-6"></div>
               <div class="col-5">
                  <div class="container w-100 bg-white rounded">
                     <div class="row">
                        <div class="col-sm-12 text-center">
                           <h2><br>Đăng Nhập</h2>
                        </div>
                     </div>
                     <form class="form-horizontal" action="login.php" method="post">
                        <div class="form-group">
                           <label class="control-label col-sm-2">Email:</label>
                           <div class="col-sm-12">
                              <input type="text" class="form-control" id="email" name="email"
                                 placeholder="Hãy nhập Email">
                              <small style="color: red"><?php echo $error;?></small>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-sm-2">Password:</label>
                           <div class="col-sm-12">
                              <input type="password" class="form-control" id="password" name="password"
                                 placeholder="Hãy nhập mật khẩu">
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-sm-offset-2 col-sm-12" style="margin-top: 5%;">
                              <button type="submit" class="btn btn-primary w-100 py-2" name="login-btn">Đăng
                                 Nhập</button>
                           </div>
                        </div>
                     </form>
                     <hr class="hr-light my-4 wow fadeInDown" data-wow-delay="0.4s">
                     <div class="row" style="margin:auto">
                        <div class="col-sm-12 text-center">
                           <p><a href="quen-mat-khau.php">Quên mật khẩu?</a></p>
                        </div>
                        <div class="col-sm-12 text-center">
                           <p>Bạn chưa có tài khoản? Hãy <a href="register.php" class="linkgt">đăng kí</a> nhé!</a></p>
                           <br>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php require_once 'view/footer.php' ?>
   </div>
</body>

</html>