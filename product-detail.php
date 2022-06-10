<!DOCTYPE html>
<html lang="en">
<?php 
require_once("controller/authController.php");
require_once("class/category.php");
require_once("class/product.php");
require_once("class/cart.php");
require_once("class/order.php"); 
//print_r($_SESSION['cart']);

?>
<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Chi tiết sản phẩm</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
   <link rel="icon"
      href="https://m.media-amazon.com/images/G/01/Zappos/MysteryDeals2021/2021-ZAPPOS-HOLIDAY-HEADER-LOGO.svg"
      type="image/x-icon" />
   <link rel="stylesheet" href="../f8-html-css/fonts/fontawesome-free-5.15.4-web/css/all.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
   <link rel="stylesheet" href="../f8-html-css/fonts/icons-1.5.0/font/bootstrap-icons.css" />
   <link rel="stylesheet" href="assets/css/grid.css" />
   <link rel="stylesheet" href="assets/css/style.css" />
   <link rel="stylesheet" href="assets/css/mycss.css" />
   <script>
   $(document).ready(function(){
        activaTab('detailtab');
    });

   function activaTab(tab){
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
   };
   $(document).ready(function(){

   var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());           
            $('#quantity').val(quantity + 1);       
    });

   $('.quantity-left-minus').click(function(e){
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
            if(quantity>1){
            $('#quantity').val(quantity - 1);
            }
    });   
    });
   </script>
</head>

<body>
   <div class="wrap">
      <?php require_once 'view/header.php';
      $id = $_GET['product-id'];
      $classproduct = new product();
      $productarray = $classproduct->getByID($conn, $id);
      $detailproductarray = $classproduct->getAllDetail($conn, $id);
      $categorysizearray = $classproduct->getSize($conn, $id);
      ?>
      <div class="content-product-detail grid wide">
      <form method="post" name="cart-form">
      <input type="text" value="<?php echo $id ?>" name="IDProduct" hidden>
         <div class="wrap-product-detail" style="padding: 0">
         <div class="row">
         <div class="col col-6">
            <img src="<?php echo $detailproductarray['Image1']?>" alt="Product Image" class="img-product">
         </div>
         <div class="col col-6">
            <div class="detail-product">
               <h1 class="dt-product-name"><?php echo $productarray['Name']?></h1>
               <div class="product-brand"><?php echo $detailproductarray['Brand']?></div>
               <div class="rating">
               <div class="row">
                  <div class="col col-6">
                  <div class="rating-star">
                    <?php 
                    for($j=1;$j<=5;$j++)
                    {
                        if($j>$classproduct->getRating($conn, $_GET['product-id'])) 
                        { ?>                           
                            <img src="assets/img/icon/starblank.png" style="height:24px, width: 24px"> 
                        <?php 
                        }
                        else
                        {
                        ?>
                            <img src="assets/img/icon/star.png" style="height:24px, width: 24px">
                        <?php
                        }
                    } 
                    ?>
                  </div>
                  </div>
                  <div class="quantity-rating mx-5">
                     <h4><?php echo  number_format($classproduct->getRating($conn, $_GET['product-id']),1) ?></h4>
                  </div>
               </div>
               </div>
               <div class="dt-product-price mt-40">
                  <span class="product-price-sale"><?php echo number_format($productarray['Price'])?>đ</span>
                  <span class="product-cost">đ</span>
               </div>
               <!--
               <div class="color mt-40">
                  <span>Màu</span>
                  <ul class="choose-color-list">
                     <li class="btn choose-color-item">Đen</li>
                     <li class="btn choose-color-item">Trắng</li>
                     <li class="btn choose-color-item">Vàng</li>
                     <li class="btn choose-color-item">Nâu</li>
                  </ul>
               </div>
               -->
               <div class="size mt-40">
                  <span>Size</span>
                  <?php 
                  for($i=1;$i<=sizeof($categorysizearray);$i++) 
                  { 
                    if($classproduct->getSizeQuantity($conn, $_GET['product-id'], $categorysizearray[$i]['Size']))
                    {
                  ?>
                     <input type="radio" class="btn-check" id="<?php echo $categorysizearray[$i]['Size']?>" name="size" value="<?php echo $categorysizearray[$i]['Size']?>" required>
                     <label class="btn btn-outline-secondary px-5" for="<?php echo $categorysizearray[$i]['Size']?>"><?php echo $categorysizearray[$i]['Size']?></label>
                  <?php } 
                    else { ?>
                     <input type="radio" class="btn-check" id="<?php echo $categorysizearray[$i]['Size']?>" name="size" value="<?php echo $categorysizearray[$i]['Size']?>" disabled>
                     <label class="btn btn-outline-secondary px-5" for="<?php echo $categorysizearray[$i]['Size']?>"><?php echo $categorysizearray[$i]['Size']?></label>
                    <?php }         
                  } ?>
               </div>
               <div class="amount mt-40">
                  <span>Số lượng</span>
                  <div class="row">
                    <div class="col-12">
                    <div class="input-group">
                          <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field=""><b>-</b></button>
                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100" readonly>
                          <button type="button" class="quantity-right-plus btn" data-type="plus" data-field=""><b>+</b></button>
                     </div>
                     </div>
                  </div>                 
               </div>
               <!-- <span class="product-available">1001 sản phẩm có sẵn</span> -->
               <div class="btn-product-detail mt-40">
                  <button type="submit" class="btn btn-add-cart" name="cart-btn">
                     <i class="fas fa-cart-plus cart-plus-icon"></i>
                     <span>Thêm vào giỏ hàng</span>
                  </button>
                  <!-- <div class="btn btn-buy-now">Mua ngay</div> -->
               </div>
            </div>
         </div>
      </div>
      </form>
      </div>
      <div class="container">
        <nav class="navbar nav nav-tabs navbar-light justify-content-center">
            <a href="#detailtab" class="btn btn-outline-secondary" data-bs-toggle="tab">Mô tả</a>
            <a href="#tutorialtab" class="btn btn-outline-secondary" data-bs-toggle="tab">Hướng dẫn bảo quản</a>
            <a href="#ratingtab" class="btn btn-outline-secondary" data-bs-toggle="tab">Đánh giá</a>
        </nav>
        <div class="tab-content" id="tabs">
            <div class="tab-pane show" id="detailtab">
                <p class="my-4"><?php echo $productarray['Description'] ?></p>
            </div>
            <div class="tab-pane" id="tutorialtab">
                <img class="img-fluid mx-auto d-block" src="assets/img/product/preserve.png">
            </div>
            <div class="tab-pane" id="ratingtab">
            <?php 
            $arraycomment = $classproduct->getReview($conn, $_GET['product-id']);
            for($i=1;$i<=sizeof($arraycomment);$i++)
            {
            $arrayaccount = $classaccount->getAccountByID($conn, $arraycomment[$i]['IDUser']);
            ?>
                <div class="row mt-20">
                    <div class="col col-2">
                    <?php 
                    for($j=1;$j<=5;$j++)
                    {
                        if($j>$arraycomment[$i]['Rating']) 
                        { ?>                           
                            <img src="assets/img/icon/starblank.png" style="height:24px, width: 24px"> 
                        <?php 
                        }
                        else
                        {
                        ?>
                            <img src="assets/img/icon/star.png" style="height:24px, width: 24px">
                        <?php
                        }
                    } 
                    ?>
                    </div>
                    <div class="col col-10"><?php echo $arrayaccount['Fullname']?> - <?php echo $classaccount->converttimedate($arraycomment[$i]['Postdate']) ?> </div>
                </div>
                <?php 
                if($arraycomment[$i]['Image']!="")
                {
                  ?>
                    <div class="row my-3">
                        <div class="col col-2">
                            <img src="<?php echo $arraycomment[$i]['Image'] ?>" class="img-fluid">
                        </div>
                        <div class="col col-10">
                        <div class="container py-3"><?php echo $arraycomment[$i]['Comments']?></div>
                        </div>
                    </div>
                <?php 
                }
                else if($arraycomment[$i]['Image']=="")
                { 
                ?>               
                <div class="row my-3">
                    <div class="container"><?php echo $arraycomment[$i]['Comments']?></div>
                </div>
            <?php } 
            }?>
            </div>
        </div>
        <hr>
      </div>
      <div class="feedback-product container">
            <h2 class="feedback-title mt-20">Đánh giá sản phẩm</h2>
            <?php if(isset($_SESSION['Fullname']))
            { 
                if($classproduct->checkBought($conn,$_SESSION['ID'],$_GET['product-id']))
                {
                    if($classproduct->getReviewByUserID ($conn, $_SESSION['ID'],$_GET['product-id']))
                    {
                    $arrayuserreview = $classproduct->getReviewByUserID ($conn, $_SESSION['ID'],$_GET['product-id']); 
                    ?>
                    <div class="container my-2">
                    <div class="row my-4">
                       <div class="col col-2">
                           <div class="rating-star">
                           <?php 
                           for($j=1;$j<=5;$j++)
                           {
                             if($j>$arrayuserreview['Rating']) 
                             { ?>                           
                                 <img src="assets/img/icon/starblank.png" style="height:24px, width: 24px"> 
                             <?php 
                             }
                             else
                             {
                             ?>
                                 <img src="assets/img/icon/star.png" style="height:24px, width: 24px">
                             <?php
                             }
                            } 
                            ?>
                          </div>
                      </div>
                      <div class="col col-10">
                        <?php echo $_SESSION['Fullname']?> - <?php echo $classaccount->converttimedate($arrayuserreview['Postdate']) ?> 
                      </div>                      
                    </div>
                    <?php 
                    if($arrayuserreview['Image']!="")
                    {
                    ?>
                        <div class="row my-4">
                            <div class="col col-3">
                                <img src="<?php echo $arrayuserreview['Image'] ?>" class="img-fluid">
                            </div>
                            <div class="col col-9">
                            <div class="container border py-5"><?php echo $arrayuserreview['Comments']?></div>
                            </div>
                        </div>
                    <?php }
                    else if($arrayuserreview['Image']=="")
                    {?>
                        <div class="row my-3 border py-5">
                            <div class="container"><?php echo $arrayuserreview['Comments']?></div>
                        </div>
                    <?php }?>
                    </div>
                <?php 
                    }
                    else
                    { ?>
                    <form method="post" name="comment-form" enctype="multipart/form-data">
                    <div class="row">
                    <input type="text" name="idproduct" id="idproduct" value="<?php echo $_GET['product-id']?>" hidden>
                    <input type="text" name="iduser" id="iduser" value="<?php echo $_SESSION['ID']?>" hidden>
                    <small style="color:red"><?php echo $error ?></small>
                    <div class="container d-flex justify-content-left" style="padding: 0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="stars">
                                    <input class="star star-5" type="radio" id="star-5" name="rating" value="5"  /> <label class="star star-5" for="star-5"></label> 
                                    <input class="star star-4" type="radio" id="star-4" name="rating" value="4" /> <label class="star star-4" for="star-4"></label> 
                                    <input class="star star-3" type="radio" id="star-3" name="rating" value="3" /> <label class="star star-3" for="star-3"></label> 
                                    <input class="star star-2" type="radio" id="star-2" name="rating" value="2" /> <label class="star star-2" for="star-2"></label> 
                                    <input class="star star-1" type="radio" id="star-1" name="rating" value="1" /> <label class="star star-1" for="star-1"></label>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <input type="file" class="form-control" id="reviewimage" name="reviewimage">
                    </div>
                    <div class="row">
                        <textarea class="form-control" id="comment" name="comment" rows="5" placeholder="Viết bình luận dưới tên <?php echo $_SESSION['Fullname']?>"></textarea>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary mt-20" name="comment-btn" id="comment-btn">Gửi</button>   
                    </div>
                    </form>
                    <?php }
                }
                else
                { 
                ?>
                <div class="container my-2">
                    <div class="row">
                        <textarea class="form-control" id="comment" name="comment" rows="5" placeholder="Hãy mua sản phẩm này để review" disabled></textarea>
                    </div>
                </div>
                <?php
                }
            }
            if(!isset($_SESSION['Fullname']))
            { 
            ?>
            <div class="container my-2">
                <div class="row">
                    <textarea class="form-control" id="comment" name="comment" rows="5" placeholder="Hãy đăng nhập để review" disabled></textarea>
                </div>
            </div>
            <?php } ?>

      </div>
      <div class="Recently-viewed-items">
         <h1>Sản phẩm đã xem</h1>
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
         <?php require_once 'view/footer.php'; ?> 
      </div>            
   </div>  
</body>
</html>