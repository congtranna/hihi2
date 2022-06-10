<?php
require_once("../../../controller/class/database.php");
$classconnection = new connection();
$conn = $classconnection->connect();
if(isset($_POST['fullname']))
{
	$iduser = $_POST['iduser'];
	$fullname = $_POST['fullname'];
	$address = $_POST['address'];
	$phonenumber = $_POST['phonenumber'];
	$type = $_POST['type'];
	$sqladdressinsert = "INSERT INTO address(IDUser,Fullname,Address,Phonenumber,Type) VALUES (?,?,?,?,?);";
	$stmt = $conn->prepare($sqladdressinsert);
	$stmt->bind_param('sssss', $iduser, $fullname, $address, $phonenumber, $type);
	$stmt->execute();
}
?>