 <?php  
 require_once("../../../controller/class/database.php");
 $classconnection = new connection();
 $conn = $classconnection->connect();  
 $iduser = $_POST['iduser'];
 $output = "";
 $sqlload = "SELECT * FROM address WHERE IDUser = ?";
 //$sqlload = "SELECT * FROM address";
 $stmt = $conn->prepare($sqlload);
 $stmt->bind_param('s',$iduser);
 $stmt->execute();
 $result = $stmt->get_result();
 while($row = $result->fetch_assoc())
 {
	  $output .= "
			<p>".$row['Address']."
			<button data-id_del='".$row['ID']."' type='button' class='btn btn-close address_del_btn' id='address_del_btn'></button></p>			 
	  ";
 }
 $numrow = mysqli_num_rows($result);
 if($numrow == 0)
 {
	  $output = "<p>Chưa có địa chỉ</p>";
 }
 echo $output;
 ?> 