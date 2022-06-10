<div class="header">
   <div class="header__top">
      <a href='index.php' class="logo">
         <img src="https://m.media-amazon.com/images/G/01/Zappos/MysteryDeals2021/2021-ZAPPOS-HOLIDAY-HEADER-LOGO.svg"
            alt="Welcome! Go to Zappos.com Homepage!" height="50" />
      </a>
      <div class="search">
         <div class="search__wrap">
            <i class="bi bi-search search__icon"></i>
            <input type="text" class="search__input" placeholder="Tìm kiếm sản phẩm của bạn"></input>
         </div>
         <div class="search__btn">SEARCH</div>
      </div>
      <div class="cart__btn ">
         <a class="cart__link" href="giohang.php"><i class="fas fa-shopping-cart cart__icon"></i>
            <span>Giỏ hàng</span></a>
         <div class="cart-list">
            <h1 class="cart-title">Giỏ hàng</h1>
            <ul class="cart-list__product">
            <?php 
            if(isset($_SESSION['cart']))
            {
            $cartsize = sizeof($_SESSION['cart']);
            for($i=0;$i<$cartsize;$i++)
			{
            ?>
               <form method="post">
               <input type="text" value="<?php echo $i ?>" name="removeid" hidden>
               <li class="cart-product-item">
                  <img src="<?php echo $_SESSION['cart'][$i]['Image']?>" alt="Sản phẩm" class="cart-product-img">
                  <div class="content-product">
                     <div class="cart__product--header">
                        <h5 class="content-product__name"><?php echo $_SESSION['cart'][$i]['Name']?></h5>
                        <div class="cart__product--value">
                           <span class="cart__product--price"><?php echo number_format($_SESSION['cart'][$i]['Price'])?>đ</span>
                           <span class="cart__product--multiply">x</span>
                           <span class="cart__product--quantity"><?php echo $_SESSION['cart'][$i]['Quantity']?></span>
                        </div>
                     </div>
                     <div class="cart__product--info">
                        <span class="cart__product--brand"><?php echo $_SESSION['cart'][$i]['Brand']?></span>
                        <button type="submit" class="btn btn-danger" name="remove-cart-btn">Xóa</button>
                     </div>
                  </div>
               </li>
               </form>
             <?php 
                }
             } 
             if(!isset($_SESSION['cart'])) 
             { ?>
                <li>Giỏ hàng trống</li>
             <?php } ?>
            </ul>
            <a href="giohang.php" class="view-cart-btn">Xem giỏ hàng</a>
         </div>
      </div>
   </div>
</div>