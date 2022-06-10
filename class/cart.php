<?php
header("Content-type: text/html; charset=utf-8");
if(isset($_POST['cart-btn']))
{
	$classproduct = new product();
	$IDProduct = $_POST['IDProduct'];
	$size = $_POST['size'];
	$quantity = $_POST['quantity'];
	$arrayproduct = $classproduct -> getByID($conn, $IDProduct);
	$arraydetailproduct = $classproduct->getAllDetail($conn, $IDProduct);	
	$cartarray = array('IDProduct' => $IDProduct , 'Quantity' => $quantity,'Size' => $size, 'Name' => $arrayproduct['Name'], 'Price' => $arrayproduct['Price'], 'Image' => $arraydetailproduct['Image1'], 'Brand' => $arraydetailproduct['Brand'], 'Description' => $arrayproduct['Description'], 'IDCategory' => $arrayproduct['IDCategory'], 'IDDetailCategory' => $arrayproduct['IDDetailCategory'], 'IDSale' => $arrayproduct['IDSale']);	
	if(!empty($_SESSION['cart']))
	{
		$cartsize = sizeof($_SESSION['cart']);
		$check = 0;
		for($i=0;$i<$cartsize;$i++)
		{
			if($_SESSION['cart'][$i]['IDProduct']==$IDProduct && $_SESSION['cart'][$i]['Size']==$size )
			{
				$sqlcheckamount = "SELECT * FROM detail_product_size_quantity WHERE IDDetailProduct=? AND Size=? LIMIT 1";
				$needcheck = $_SESSION['cart'][$i]['IDProduct'];
				$stmt = $conn->prepare($sqlcheckamount);
				$stmt->bind_param('ss',$needcheck,$size);
				$stmt->execute();
				$result = $stmt->get_result();
				$row = $result->fetch_assoc();					
				if($row['Quantity']<($_SESSION['cart'][$i]['Quantity']+$quantity) || $row['Quantity']==0)
				{					
				echo "<script type='text/javascript'>alert('Sản phẩm không đủ số lượng');</script>";
				$check=1;
				break;
				}
				else
				{
				$_SESSION['cart'][$i]['Quantity']+=$quantity;
				$check=1;
				break;
				}
			}
		}
		if($check==0)
		{
			$_SESSION['cart'][$cartsize]=$cartarray;			
		}		
	}
	else
	{	
		$sqlcheckamount = "SELECT * FROM detail_product_size_quantity WHERE IDDetailProduct=? AND Size=? LIMIT 1";
		$stmt = $conn->prepare($sqlcheckamount);
		$stmt->bind_param('ss',$IDProduct,$size);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();					
		if($row['Quantity']<($quantity) || $row['Quantity']==0)
		{		
			echo "<script type='text/javascript'>alert('Sản phẩm không đủ số lượng');</script>";	
		}
		else
		{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]=$cartarray;
		}
	}
}
if(isset($_POST['remove-cart-btn']))
{
	$removeid = $_POST['removeid'];
	unset($_SESSION['cart'][$removeid]);
	$_SESSION['cart'] = array_values($_SESSION['cart']);
	if(sizeof($_SESSION['cart'])==0)
	{
		unset($_SESSION['cart']);
		header("../index.php");
	}
	header("giohang.php");
}

?>