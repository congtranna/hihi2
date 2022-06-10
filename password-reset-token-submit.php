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
   <title><?php echo $title ?></title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="icon"
      href="https://m.media-amazon.com/images/G/01/Zappos/MysteryDeals2021/2021-ZAPPOS-HOLIDAY-HEADER-LOGO.svg"
      type="image/x-icon" />
   <link rel="stylesheet" href="css/email.css">
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
      <?php require_once 'view/header-account.php'; ?>
      <div class="container-fluid" style="padding: 0">
         <div class="view">
            <div class="mask rgba-black-light align-items-center">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12 mb-4 white-text text-center">
                        <h1 class="h1-reponsive white-text text-uppercase font-weight-bold mb-0 pt-md-5 pt-5 wow fadeInDown"
                           data-wow-delay="0.3s"><strong
                              style="color: black"><br><br><br><br><br><?php echo "Đã gửi link reset đến mail"?></strong>
                        </h1>
                        <br>
                        <h5 class="text-uppercase mb-4 white-text wow fadeInDown" data-wow-delay="0.4s"><strong
                              style="color:black"><?php echo "Hãy check mail để lấy link nhé!"?></strong></h5>
                        <a class="btn btn-outline-white wow fadeInDown" data-wow-delay="0.4s"></a>
                        <a class="btn btn-outline-white wow fadeInDown" data-wow-delay="0.4s"></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php require_once 'view/footer.php'; ?>
   </div>
</body>

</html>