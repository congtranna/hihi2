<?php
require_once("../../../controller/class/database.php");
$classconnection = new connection();
$conn = $classconnection->connect();
if(isset($_POST['id']))
{
	$id = $_POST['id'];
	$sqladdressinsert = "DELETE FROM address WHERE ID=?;";
	$stmt = $conn->prepare($sqladdressinsert);
	$stmt->bind_param('s', $id);
	$stmt->execute();
}
?>