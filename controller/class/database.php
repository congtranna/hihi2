<?php 
class connection
{
	public function connect()
	{
		$conn = new mysqli("localhost", "root", "", "ecommerce");
		mysqli_set_charset($conn, 'UTF8');
		if($conn->connect_error)
		{
			die('Database error: ' .$conn->connect_error);
			return false;
		}
		return $conn;
	}
}
    
?>