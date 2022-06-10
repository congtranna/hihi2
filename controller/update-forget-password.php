<?php
if(isset($_GET['password']) && $_GET['reset_link_token'] && $_GET['email'])
{
include ("class/database.php");
$classconnect = new connection();
$conn = $classconnect->connect();
$curDate = date("Y-m-d H:i:s");
$email = $_GET['email'];
$token = $_GET['reset_link_token'];
$password = $_GET['password'];
$query1 = mysqli_query($conn,"SELECT Password FROM `users` WHERE `token`='".$token."' and `Email`='".$email."'");
$query = "SELECT * FROM `users` WHERE `token`='".$token."' and `Email`='".$email."';";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$rowcount = mysqli_num_rows($result);
$row=$result->fetch_assoc();

	if($row['exp_date'] < $curDate)
	{
		header ("location: ../reset-password-timeout.php");
		exit();
	}
	else if ($row['exp_date'] >= $curDate)
	{
		if($rowcount == 1 ) 
			{	
			$password_info=mysqli_fetch_array($query1);
			$sha_info = explode("$",$password_info[0]);
   			} 
  			if( $sha_info[1] === "SHA" ) 
			{
				$salt = $sha_info[2];
				$passwordencrypted = '$SHA$'.$salt.'$'.hash('sha256',hash('sha256', $password).$salt);
				mysqli_query($conn,"UPDATE users SET Password='" . $passwordencrypted . "', token='" . NULL . "' ,exp_date='" . NULL . "' WHERE Email='" . $email . "'");
		//		echo '<p>Congratulations! Your password has been updated successfully.</p>';
				header ('location: ../index.php');
				echo '<script type="text/javascript">toastr.error("Có lỗi máy chủ vui lòng thử lại sau!");</script>';
			}
	}
}
?>