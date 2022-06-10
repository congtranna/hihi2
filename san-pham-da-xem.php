<!DOCTYPE html>
<html lang="en">
<?php 
require_once("controller/authController.php");
require_once("class/category.php");
require_once("class/product.php");
require_once("class/cart.php");
require_once("class/order.php");
$classcategory = new category();
//$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$current_url = explode("?", $_SERVER['REQUEST_URI']);
$url = $current_url[0];
?>
<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Category</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.min.js"></script>
   <link rel="icon"
      href="https://m.media-amazon.com/images/G/01/Zappos/MysteryDeals2021/2021-ZAPPOS-HOLIDAY-HEADER-LOGO.svg"
      type="image/x-icon" />
   <link rel="stylesheet" href="assets/fonts/icons-1.5.0/font/bootstrap-icons.css" />
   <link rel="stylesheet" href="assets/honts/fontawesome-free-5.15.4-web/css/all.css" />
   <link rel="stylesheet" href="assets/css/grid.css" />
   <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
   <div class="wrap">
      <?php require_once 'view/header.php'; ?>
      <div class="content-category">
         <div class="grid wide">
            <div class="header-content">
               <div class="product-category">
                  <h2 class="category-name">Sản phẩm đã xem</h2>
                  <span>
                  <?php 
                  if(isset($_SESSION['History']))
                  {
                  $classproduct = new product();  
                  $countsp =  sizeof($_SESSION['History']);
                  echo $countsp;
                  }
                  else
                  {
                  echo "0";
                  }
                  ?> sản phẩm tìm thấy</span>
               </div>
               <div class="sort-product">
                  <div class="sort-product__chose">
                     <span>Sắp xếp theo</span>
                     <i class="fas fa-chevron-down chevron-down-icon"></i>
                     <ul class="chose-sort">
                        <li class="sort-item">
                           Giá từ cao đến thấp
                        </li>
                        <li class="sort-item">
                           Giá từ thấp đến cao
                        </li>
                     </ul>
                  </div>

               </div>
            </div>
            <div class="row filter-detail">
               <div class="filter col l-2-4">
                  <span class="filter__title">Tìm Kiếm Chi Tiết</span>
                  <div class="filter__brand">
                     <span class="brand-title">Thương Hiệu</span>
                     <div class="filter-category__name">
                        <input type="checkbox" name="Nike" id="check-brand">
                        <span>Nike</span>
                     </div>
                     <div class="filter-category__name">
                        <input type="checkbox" name="Adidas" id="check-brand">
                        <span>Adisdas</span>
                     </div>
                     <div class="filter-category__name">
                        <input type="checkbox" name="Conveser" id="check-brand">
                        <span>Conveser</span>
                     </div>
                  </div>
                  <div class="filter__price">
                     <span class="filter__price-title">Khoảng giá</span>
                     <div class="wrap-filter__price">
                        <input type="text" name="first price" id="first-price">
                        <span> - </span>
                        <input type="text" name="last price" id="last-price">
                     </div>
                  </div>
               </div>
               <div class="list-product col l-9-6">
                  <div class="row">
                  <?php          
                  $count=0;
                  $position = 0;
                  if(isset($_GET['page']))
                  {
                        if(($_GET['page'])==1)
                        {
                            $position = 0;
                        }
                        if(($_GET['page'])>=2)
                        {
                            for($i=1;$i<$_GET['page'];$i++)
                            {
                            $position = ($position+8);
                            }
                        }
                  }
                  for($i=$position; $i<sizeof($_SESSION['History']);$i++)
                  {
                  $count++;                 
                  if($count<=8)
                  {          
                  $productarray = $classproduct->getByID($conn, $_SESSION['History'][$i]['ID']);  
                  $detailproductarray = $classproduct->getAllDetail($conn, $productarray['ID']);
                  ?>
                     <div class="col-3 my-2">
                        <a href="product-detail.php?product-id=<?php echo $productarray['ID'] ?>" class="product-item">
                           <div class="wrap-img">
                              <img src="<?php echo $detailproductarray['Image1']?>" alt="Product Image" class="product-img">
                           </div>
                           <div class="product-like">
                              <i class="far fa-heart"></i> <span><?php echo  number_format($classproduct->getRating($conn, $productarray['ID']),1) ?></span>
                           </div>
                           <div class="product-content">
                              <div class="product-name"><?php echo $productarray['Name'];?></div>
                              <div class="product-brand"><?php echo $detailproductarray['Brand'];?></div>
                              <div class="price">
                                 <small><?php echo $productarray['Sold']?> sản phẩm đã bán</small>
                                 <span class="product-price-sale"><?php echo number_format($productarray['Price']);?>đ</span>
                              </div>
                           </div>
                        </a>
                     </div>
                  <?php } }
                  if(isset($countsp) && $countsp==0)
                  { ?>
                    <div class="col col-4"></div>
                    <div class="col col-6">
                    <h4>Không tìm thấy sản phẩm</h4>
                    </div>
                  <?php
                  }
                  ?>
                  </div>
                  <ul class="pagination home-product__pagination">
                      <li class="pagination-item">
                      <?php 
                      $totalpage = sizeof($_SESSION['History'])/8;
                      if((sizeof($_SESSION['History'])%8)!=0)
                      {
                            $totalpage++;
                      }
                      if(isset($_GET['filter']))
                      {
                        $type = "filter";
                        $value = $_GET['filter'];
                      }
                      if(isset($_GET['filter-detail']))
                      {
                        $type = "filter-detail";
                        $value = $_GET['filter-detail'];
                      }
                      if(isset($_GET['keyword']))
                      {
                        $type = "keyword";
                        $value = $_GET['keyword'];
                      }
                      if(isset($_GET['page']))
                      {
                      $thispage = $_GET['page']; 
                      if($thispage>1)
                        {            
                      ?>
                          <a href="<?php echo $url.'?page='.$thispage-1 ?>" class="pagination-item__link">
                          <i class="pagination-item__icon bi bi-chevron-left"></i>
                          </a>
                      </li>
                      <?php }} ?>
                      <?php                                
                      for($i=1; $i<=$totalpage;$i++)
                      {
                      ?>
                      <li class="pagination-item pagination-item--active">
                          <a href="<?php echo $url.'?page='.$i ?>" class="pagination-item__link"><?php echo $i ?></a>
                      </li>
                      <?php } ?>
                      <li class="pagination-item">
                      <?php
                      if(isset($_GET['page']))
                      {
                        if($thispage<$totalpage-1)
                        {             
                      ?>
                          <a href="<?php echo $url.'?page='.$thispage+1 ?>" class="pagination-item__link">
                          <i class="pagination-item__icon bi bi-chevron-right"></i>
                          </a>
                      </li>
                      <?php }} ?>
                  </ul>
               </div>
            </div>

         </div>
      </div>
      <?php require_once 'view/footer.php'; ?>
   </div>
    <script>
    document.addEventListener("DOMContentLoaded", function (event) {
        var scrollpos = sessionStorage.getItem('scrollpos');
        if (scrollpos) {
            window.scrollTo(0, scrollpos);
            sessionStorage.removeItem('scrollpos');
        }
    });

    window.addEventListener("beforeunload", function (e) {
        sessionStorage.setItem('scrollpos', window.scrollY);
    });
   </script>
</body>

</html>