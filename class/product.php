<?php
header("Content-type: text/html; charset=utf-8");

class product
{
	public $error="";
	public function getAll ($conn)
	{
		$sql = "SELECT * FROM product;";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		$count = 1;
		while ($row = $result->fetch_assoc())
		{	
			$array[$count]['ID'] = $row['ID'];
			$array[$count]['Name'] = $row['Name'];	
			$array[$count]['Price'] = $row['Price'];
			$array[$count]['Description'] = $row['Description'];
			$array[$count]['IDCategory'] = $row['IDCategory'];	
			$array[$count]['IDDetailCategory'] = $row['IDDetailCategory'];
			$array[$count]['IDSale'] = $row['IDSale'];
			$array[$count]['newArrival'] = $row['newArrival'];	
			$array[$count]['Sold'] = $row['Sold'];	
			$count++;
		}  
		return $array;
	}
	public function getAllSearch ($conn,$keyword)
	{
		$sql = "SELECT * FROM product WHERE Name LIKE '%".$keyword."%';";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		$count = 1;
		while ($row = $result->fetch_assoc())
		{	
			$array[$count]['ID'] = $row['ID'];
			$array[$count]['Name'] = $row['Name'];	
			$array[$count]['Price'] = $row['Price'];
			$array[$count]['Description'] = $row['Description'];
			$array[$count]['IDCategory'] = $row['IDCategory'];	
			$array[$count]['IDDetailCategory'] = $row['IDDetailCategory'];
			$array[$count]['IDSale'] = $row['IDSale'];
			$array[$count]['newArrival'] = $row['newArrival'];	
			$array[$count]['Sold'] = $row['Sold'];	
			$count++;
		}  
		return $array;
	}
	public function getAllDescend ($conn)
	{
		$sql = "SELECT * FROM product ORDER BY Sold DESC;";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		$count = 1;
		while ($row = $result->fetch_assoc())
		{	
			$array[$count]['ID'] = $row['ID'];
			$array[$count]['Name'] = $row['Name'];	
			$array[$count]['Price'] = $row['Price'];
			$array[$count]['Description'] = $row['Description'];
			$array[$count]['IDCategory'] = $row['IDCategory'];	
			$array[$count]['IDDetailCategory'] = $row['IDDetailCategory'];
			$array[$count]['IDSale'] = $row['IDSale'];
			$array[$count]['newArrival'] = $row['newArrival'];	
			$array[$count]['Sold'] = $row['Sold'];	
			$count++;
		}  
		return $array;
	}
	public function getAllSearchConstraint ($conn,$field,$constraint)
	{
		if($field=="filter")
		{
		$sql = "SELECT product.ID,product.Name,product.Price,product.Sold,category.Name as CateName FROM (product INNER JOIN category ON product.IDCategory=category.ID) WHERE filter='$constraint'";
		}
		if($field=="filter-detail")
		{
		$sql = "SELECT product.ID,product.Name,product.Price,product.Sold,detail_category.Name as DetailCateName,detail_category.filter
			FROM (product INNER JOIN detail_category ON product.IDDetailCategory=detail_category.ID
						INNER JOIN category ON product.IDCategory=category.ID) WHERE detail_category.filter='$constraint'";
		}
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		$count = 1;
		while ($row = $result->fetch_assoc())
		{	
			$array[$count]['ID'] = $row['ID'];
			$array[$count]['Name'] = $row['Name'];	
			$array[$count]['Price'] = $row['Price'];
			$array[$count]['Sold'] = $row['Sold'];
			$count++;
		}  
		return $array;
	}
	public function getAllDetail ($conn, $id)
	{
		$sql = "SELECT * FROM detail_product WHERE IDProduct=?;";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		//$count = 1;
		while ($row = $result->fetch_assoc())
		{	
			$array['ID'] = $row['ID'];
			$array['IDProduct'] = $row['IDProduct'];
			$array['Brand'] = $row['Brand'];
			$array['Image1'] = $row['Image1'];
			$array['Image2'] = $row['Image2'];	
			//$count++;
		}  
		return $array;
	}
	public function getByID ($conn, $id)
	{
		$sql = "SELECT * FROM product WHERE ID=?;";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		while ($row = $result->fetch_assoc())
		{	
			$array['ID'] = $row['ID'];
			$array['Name'] = $row['Name'];	
			$array['Price'] = $row['Price'];
			$array['Description'] = $row['Description'];
			$array['IDCategory'] = $row['IDCategory'];	
			$array['IDDetailCategory'] = $row['IDDetailCategory'];
			$array['IDSale'] = $row['IDSale'];
			$array['newArrival'] = $row['newArrival'];	
			$array['Sold'] = $row['Sold'];
		}  
		return $array;
	}
	public function getReview ($conn, $id)
	{
		$sql = "SELECT * FROM comments WHERE IDProduct=?;";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		$count=1;
		while ($row = $result->fetch_assoc())
		{	
			$array[$count]['ID'] = $row['ID'];
			$array[$count]['IDProduct'] = $row['IDProduct'];	
			$array[$count]['IDUser'] = $row['IDUser'];
			$array[$count]['Comments'] = $row['Comments'];
			$array[$count]['Rating'] = $row['Rating'];	
			$array[$count]['Image'] = $row['Image'];
			$array[$count]['Postdate'] = $row['Postdate'];
			$count++;
		}  
		return $array;
	}
	public function getReviewByUserID ($conn, $iduser, $id)
	{
		$sql = "SELECT * FROM comments WHERE IDProduct=? AND IDUser=?;";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ss',$id,$iduser);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		while ($row = $result->fetch_assoc())
		{	
			$array['ID'] = $row['ID'];
			$array['IDProduct'] = $row['IDProduct'];	
			$array['IDUser'] = $row['IDUser'];
			$array['Comments'] = $row['Comments'];
			$array['Rating'] = $row['Rating'];	
			$array['Image'] = $row['Image'];
			$array['Postdate'] = $row['Postdate'];
		}  
		return $array;
	}
	public function getRating ($conn, $id)
	{
		$sql = "SELECT * FROM comments WHERE IDProduct=?;";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		$rownum = mysqli_num_rows($result);
		$s=0;
		$count=0;
		if($rownum != 0)
		{
			while ($row = $result->fetch_assoc())
			{	
				$rate = $row['Rating'];
				$s=$s+$rate;
				$count++;
			}  
			$total = $s/$count;
			return $total;
		}	
	}
	public function getSize ($conn, $id)
	{
		$sql = "SELECT * FROM detail_product_size_quantity WHERE IDDetailProduct=?;";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		$count=1;
		while ($row = $result->fetch_assoc())
		{	
			$array[$count]['ID'] = $row['ID'];
			$array[$count]['Size'] = $row['Size'];	
			$array[$count]['IDDetailProduct'] = $row['IDDetailProduct'];;
			$count++;
		}  
		return $array;
	}
	public function getSizeQuantity ($conn, $id, $size)
	{
		$sqlcheckamount = "SELECT * FROM detail_product_size_quantity WHERE IDDetailProduct=? AND Size=? LIMIT 1";
		$stmt = $conn->prepare($sqlcheckamount);
		$stmt->bind_param('ss',$id,$size);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$array = array();
		if($row['Quantity']==0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	public function checkBought ($conn, $iduser, $idproduct)
	{
		$sql = "SELECT * FROM (detail_order INNER JOIN orders ON detail_order.IDOrder=orders.ID) WHERE IDUser=? AND IDProduct=?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ss',$iduser,$idproduct);
		$stmt->execute();
		$result = $stmt->get_result();
		$numrow = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if($numrow==0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}

?>