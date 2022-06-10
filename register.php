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
   <title>Đăng ký</title>
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
         <div class="container-fluid py-3">
            <div class="row" style="padding: 0">
               <div class="col-6"></div>
               <div class="col-5">
                  <div class="container w-100 bg-white rounded">
                     <div class="row">
                        <div class="col-sm-12 text-center">
                           <h2><br>Đăng Ký</h2>
                        </div>
                     </div>
                     <form class="form-horizontal" action="register.php" method="post">
                        <div class="form-group">
                           <label class="control-label col-sm-6">Email:</label>
                           <div class="col-sm-12">
                              <input type="text" class="form-control" id="email" name="email"
                                 placeholder="Hãy nhập email">
                              <small style="color: red"><?php echo $error;?></small>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-sm-6">Họ và Tên: </label>
                           <small style="color: red"><?php echo $error2;?></small>
                           <div class="col-sm-12">
                              <input type="text" class="form-control" id="fullname" name="fullname"
                                 placeholder="Hãy nhập họ và tên">
                           </div>
                        </div>                       
                        <div class="form-group">
                           <label class="control-label col-sm-6">Password: </label>
                           <small style="color: red"><?php echo $error2;?></small>
                           <div class="col-sm-12">
                              <input type="password" class="form-control" id="password" name="password"
                                 placeholder="Hãy nhập mật khẩu">
                           </div>
                        </div>                        
                        <div class="form-group">
                           <div class="col-sm-offset-2 col-sm-12" style="margin-top: 5%;">
                              <button type="submit" class="btn btn-primary w-100 py-2" name="register-btn">Đăng
                                 Ký</button>
                           </div>
                        </div>
                     </form>
                     <hr class="hr-light my-4 wow fadeInDown" data-wow-delay="0.4s">
                     <div class="row" style="margin:auto">
                        <div class="col-sm-12 text-center">
                           <p><a href="quen-mat-khau.php">Quên mật khẩu?</a></p>
                        </div>
                        <div class="col-sm-12 text-center">
                           <p>Bạn đã có tài khoản? Hãy <a href="login.php" class="linkgt">đăng nhập</a> nhé!</p><br>
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