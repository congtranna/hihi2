<div class="header">
   <div class="header__top">
      <a href='index.php' class="logo">
         <img src="https://m.media-amazon.com/images/G/01/Zappos/MysteryDeals2021/2021-ZAPPOS-HOLIDAY-HEADER-LOGO.svg"
            alt="Welcome! Go to Zappos.com Homepage!" height="50" />
      </a>
      <form method="post">
      <div class="search">        
         <div class="search__wrap">
            <i class="bi bi-search search__icon"></i>
            <input type="text" class="search__input" id="keyword" name="keyword" placeholder="Tìm kiếm sản phẩm của bạn"></input>
         </div>
         <button type="submit" id="search-btn" name="search-btn" class="search__btn">SEARCH</button>        
      </div>
      </form>
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
   <div class="header__bottom">
      <ul class="nav__list">
         <?php 
            $classcategory = new category();
            $arraycategory = $classcategory->getAll($conn);
            for($i=1;$i<=sizeof($arraycategory);$i++)
            { 
            ?>
            <li class="nav-item">
                <span><a href="category.php?filter=<?php echo $arraycategory[$i]['Filter']?>" style="color:black;text-decoration:none"><?php echo $arraycategory[$i]['Name']?></a></span>
                <ul class="clothing__list">
                <?php 
                $arraydetailcategory = $classcategory->getAllDetail($conn,$i);
                for($j=1;$j<=sizeof($arraydetailcategory);$j++)
                {
                ?>
                   <li class="clothing__item"><a href="category.php?filter-detail=<?php echo $arraydetailcategory[$j]['Filter']?>" class=item__link><?php echo $arraydetailcategory[$j]['Name']?></a></li>
                <?php } ?>
                </ul>
             </li>
            <?php 
            } 
            ?>
        <!--         
        <li class="nav-item">
            <span> Gợi Ý Mua Hàng </span>
            <ul class="clothing__list">
               <li class="clothing__item"><a href="#" class=item__link>Quần jeans</a></li>
               <li class="clothing__item"><a href="#" class=item__link>Quần Bó</a></li>
               <li class="clothing__item"><a href="#" class=item__link>Quần Jockger</a></li>
               <li class="clothing__item"><a href="#" class=item__link>Quần Sort</a></li>
            </ul>
         </li>
         -->
      </ul>
      <ul class="nav__list" style="margin-right: 4%">
      <?php if(!isset($_SESSION['Fullname'])) { ?>
         <a href="login.php" class="login-title" style="color: inherit; text-decoration: none;"><li class="nav-item">      
             Đăng Nhập                    
         </li></a>
         <a href="register.php" class="register-title" style="color: inherit; text-decoration: none;"><li class="nav-item">
             Đăng Ký
         </li></a>
      <?php } ?>
      <?php if(isset($_SESSION['Fullname'])) { ?>
      <li class="nav-item">
      Tài khoản của tôi
        <ul class="clothing__list">
               <li class="clothing__item"><b>Xin chào, <?php 
               $parts = explode(" ", $_SESSION['Fullname']);
               if(count($parts) > 1) {
                   $lastname = array_pop($parts);
                   $firstname = implode(" ", $parts);
               }
               else
               {
                   $firstname = $_SESSION['Fullname'];
                   $lastname = " ";
               }
               echo $lastname; 
               ?></b></li>
               <li class="clothing__item"><a href="profile.php" class=item__link>Tổng quan tài khoản</a></li>
               <li class="clothing__item"><a href="order-list.php" class=item__link>Xem đơn đặt hàng</a></li>
               <li class="clothing__item"><a href="index.php?logout" class=item__link>Đăng xuất</a></li>
        </ul>
      </li>
      <li class="nav-item"></li>
      <?php } ?>            
      </ul>
   </div>
</div>