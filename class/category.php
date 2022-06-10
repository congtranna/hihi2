<?php
header("Content-type: text/html; charset=utf-8");

class category
{
	public $error="";
	public function getAll ($conn)
	{
		$sql = "SELECT * FROM category;";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		$count = 1;
		while ($row = $result->fetch_assoc())
		{	
			$array[$count]['ID'] = $row['ID'];
			$array[$count]['Name'] = $row['Name'];	
			$array[$count]['Filter'] = $row['filter'];
			$count++;
		}  
		return $array;
	}
	public function getAllDetail ($conn, $id)
	{
		$sql = "SELECT * FROM detail_category WHERE IDCategory=?;";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		$count = 1;
		while ($row = $result->fetch_assoc())
		{	
			$array[$count]['ID'] = $row['ID'];
			$array[$count]['IDCategory'] = $row['IDCategory'];
			$array[$count]['Name'] = $row['Name'];
			$array[$count]['Filter'] = $row['filter'];	
			$count++;
		}  
		return $array;
	}
	public function getName ($conn,$name)
	{
		$sql = "SELECT * FROM category WHERE filter=?;";		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$name);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		while ($row = $result->fetch_assoc())
		{	
			$array['ID'] = $row['ID'];
			$array['Name'] = $row['Name'];	
			$array['Filter'] = $row['filter'];
		}  
		return $array;
	}
	public function getDetailName ($conn,$name)
	{
		$sql = "SELECT * FROM detail_category WHERE filter=?;";		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$name);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		while ($row = $result->fetch_assoc())
		{	
			$array['ID'] = $row['ID'];
			$array['Name'] = $row['Name'];	
			$array['Filter'] = $row['filter'];
		}  
		return $array;
	}
}

?>