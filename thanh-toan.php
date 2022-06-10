<!DOCTYPE html>
<html lang="en">
<?php
require_once("class/category.php");
require_once("class/product.php");
require_once("class/cart.php");
require_once("class/order.php"); 
require_once("controller/authController.php");
if(!isset($_SESSION['cart']))
{
    header("location: index.php");
    exit();
}
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
            <h2 class="my-4">Thanh toán</h2><hr>
            <form action="index.php" method="post">
            <div class="container">
            <div class="row">
                <div class="col col-4">
                    <h4>Thông tin nhận hàng</h4>
                    <?php if(!isset($_SESSION['Fullname']))
                    { ?>                       
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                        <label for="fullname" class="form-label my-2">Họ và tên</label>
                        <input type="text" id="fullname" name="fullname" class="form-control" required>
                        <label for="phonenumber" class="form-label my-2">Số điện thoại</label>
                        <input type="text" id="phonenumber" name="phonenumber" class="form-control" required>
                        <label for="address" class="form-label my-2">Địa chỉ</label>
                        <input type="text" id="address" name="address" class="form-control" required>
                        <label for="note" class="form-label my-2">Ghi chú</label>
                        <textarea class="form-control" id="note" name="note" rows="5" placeholder="Viết ghi chú"></textarea>
                    <?php
                    } 
                    else
                    {
                        if(!$classaccount->getAccountAddress($conn, $_SESSION['ID'])) 
                        { ?>
                            <input type="text" value="<?php echo $_SESSION['ID']?>" id="idhidden" name="idhidden" class="form-control" hidden>
                            <label for="email"value="<?php echo $_SESSION['Email']?>" class="form-label">Email</label>
                            <input type="email" value="<?php echo $_SESSION['Email']?>" id="email" name="email" class="form-control" required>
                            <label for="fullname" class="form-label my-2">Họ và tên</label>
                            <input type="text" value="<?php echo $_SESSION['Fullname']?>" id="fullname" name="fullname" class="form-control" required>
                            <label for="phonenumber" class="form-label my-2">Số điện thoại</label>
                            <input type="text" id="phonenumber" name="phonenumber" class="form-control" required>
                            <label for="address" class="form-label my-2">Địa chỉ</label>
                            <input type="text" id="address" name="address" class="form-control" required>
                            <label for="note" class="form-label my-2">Ghi chú</label>
                            <textarea class="form-control" id="note" name="note" rows="5" placeholder="Viết ghi chú"></textarea>
                        <?php 
                        } else {
                        ?>
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="<?php echo $_SESSION['Email']?>" id="email" class="form-control" readonly>
                        <label for="addressdropdown" class="form-label my-2">Địa chỉ</label>
                        <select id="addressdropdown" name="addressdropdown" class="form-control">
                            <option value="">Chọn địa chỉ</option>
                            <?php 
                            $addressarray = $classaccount->getAccountAddress($conn, $_SESSION['ID']);
                            for($i=0;$i<sizeof($addressarray);$i++)
                            {
                            ?>
                            <option value="<?php echo $addressarray[$i]['ID'] ?>"><?php echo $addressarray[$i]['Address'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label for="note" class="form-label">Ghi chú</label>
                        <textarea class="form-control" id="note" name="note" rows="5" placeholder="Viết ghi chú"></textarea>
                    <?php
                    } }
                    ?>                   
                </div>
                <div class="col col-4">
                    <h4>Vận chuyển</h4>
                   <input type="radio" class="btn-check" id="giaohang" name="giaohang" value="Shiptohouse" required checked>
                     <label class="btn btn-outline-secondary px-5 my-2" for="giaohang">Giao hàng tận nơi</label>
                    <h4 class="my-3">Thanh toán</h4>
                    <div id="accordion">
                        <div class="container-fluid border py-3" id="tabnganhang">
                          <b class="mb-0">
                            <input type="radio" name="shiptype" id="shiptype" value="Bank" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" required>
                            Chuyển khoản qua ngân hàng
                          </b>
                        </div>
                        <div id="collapseOne" class="collapse border" aria-labelledby="tabnganhang" data-bs-parent="#accordion">
                          <div class="card-body">
                            Ngân hàng Agribank Chi Nhánh An Phú<br>Số TK: 1606201036100<br>Người nhận: Trường ĐH Sài gòn
                          </div>
                        </div>
                        <div class="container-fluid border py-3" id="tabcod">
                          <b class="mb-0">
                            <input type="radio" name="shiptype" id="shiptype" value="COD" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" required>
                            Thanh toán khi giao hàng (COD)
                          </b>
                        </div>
                        <div id="collapseTwo" class="collapse border" aria-labelledby="tabcod" data-bs-parent="#accordion">
                          <div class="card-body">
                            Bạn chỉ phải thanh toán khi nhận được hàng
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col col-4">
                <?php 
                $tongcong = 0;
                for($i=0;$i<sizeof($_SESSION['cart']);$i++)
                { 
                $tongcong = $tongcong + $_SESSION['cart'][$i]['Price'];
                ?>
                    <div class="row">
                        <div class="col col-3">
                            <img class="rounded" src="<?php echo $_SESSION['cart'][$i]['Image'] ?>" style="height: 80px; width: 80px">
                        </div>
                        <div class="col col-7">
                            <p><?php echo $_SESSION['cart'][$i]['Name'] ?></p>
                            <p>Số lượng: <?php echo $_SESSION['cart'][$i]['Quantity'];?> Size: <?php echo $_SESSION['cart'][$i]['Size']; ?></p>
                        </div>
                        <div class="col col-2">
                            <p><?php echo number_format($_SESSION['cart'][$i]['Price']) ?>đ</p>
                        </div>
                    </div>
                    <hr>
                <?php }
                ?>
                    <div class="row">
                        <div class="col col-10">Tạm tính: </div>
                        <div class="col col-2"><?php echo number_format($tongcong) ?>đ</div>
                    </div>
                    <div class="row my-3">
                        <div class="col col-10">Phí vận chuyển: </div>
                        <div class="col col-2">25.000đ</div>
                    </div>
                    <hr>
                    <?php 
                    if(isset($_SESSION['Fullname']))
                    {
                    $classorder = new order();
                    if($classorder->getGiftCodeForUser($conn,$_SESSION['ID']))
                    {
                    $arraygiftcode = $classorder->getGiftCodeForUser($conn,$_SESSION['ID']);
                    ?>
                    <div class="row">
                        <div class="col col-7">Nhập mã giảm giá: </div>
                        <div class="col col-5">Bạn có <?php echo sizeof($arraygiftcode) ?> mã giảm</div>
                    </div>
                    <select class="form-control my-3" id="giftcode" name="giftcode">
                        <option value="0">Chọn mã giảm giá</option>
                        <?php 
                        for($i=0;$i<sizeof($arraygiftcode);$i++) 
                        { ?>
                        <option value="<?php echo $arraygiftcode[$i]['IDGiftCode']?>"><?php echo $arraygiftcode[$i]['Name']?></option>
                        <?php } ?>
                    </select>
                    <hr>
                    <?php }} ?>
                    <div class="row my-3">
                        <div class="col col-10">Tổng cộng: </div>
                        <div class="col col-2"><?php echo number_format($tongcong+25000) ?>đ</div>
                    </div>
                    <div class="row my-4">
                        <div class="col col-8"><a href="giohang.php" style="color:red; text-decoration:none"> < Quay về giỏ hàng</a></div>
                        <div class="col col-4"><button type="submit" name="checkout-btn" id="checkout-btn" class="btn btn-danger w-100 py-2">Đặt hàng</button></div>
                    </div>
                </div>
            </div>
            </form>
            </div>
         </div>
      <?php require_once 'view/footer.php' ?>
   </div>
   <script src="assets/js/app.js"></script>
</body>
</html>