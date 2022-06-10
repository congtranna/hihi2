<?php

class account
{
	public function getAccount($email,$conn)
	{
	$account = array();
	$sql = "SELECT * FROM users WHERE Email=? LIMIT 1;";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();
	$row = $result->num_rows;
	if($row==0)
		{
			return false;
		}
	else 
		{
			$account = array("ID"=>$user['ID'],"Email"=>$user['Email'],"Password"=>$user['Password'],"Fullname"=>$user['Fullname'],"Phonenumber"=>$user['Phonenumber'],"regdate"=>$user['regdate'],"lastlogin"=>$user['lastlogin']);
			return $account;
		}
	}
	public function getAccountByID($conn, $id)
	{
	$account = array();
	$sql = "SELECT * FROM users WHERE ID=? LIMIT 1;";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('s', $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();
	$row = $result->num_rows;
	if($row==0)
		{
			return false;
		}
	else 
		{
			$account = array("ID"=>$user['ID'],"Email"=>$user['Email'],"Password"=>$user['Password'],"Fullname"=>$user['Fullname'],"Phonenumber"=>$user['Phonenumber'],"regdate"=>$user['regdate'],"lastlogin"=>$user['lastlogin']);
			return $account;
		}
	}
	public function addAccount ($account,$conn)
	{	
		$sql = "SELECT * FROM users WHERE Email=? LIMIT 1;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account['Email']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_num_rows($result);
        $user = $result->fetch_assoc();
            if($row == 0)
			{
				$sqlinsert = "INSERT INTO users(Email,Password,Fullname,regdate) VALUES (?,?,?,?);";
				$stmtinsert = $conn->prepare($sqlinsert);
				$stmtinsert->bind_param('ssss',$account['Email'],$account['Password'],$account['Fullname'],$account['regdate']);
				$stmtinsert->execute();  
				return true;
            }
            else
			{
                return false;
            } 
	}
	public function getAccountAddress($conn, $id)
	{
		$sql = "SELECT * FROM address WHERE IDUser=?;";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		$count=0;
		while ($row = $result->fetch_assoc())
		{	
			$array[$count]['ID'] = $row['ID'];
			$array[$count]['IDUser'] = $row['IDUser'];
			$array[$count]['Fullname'] = $row['Fullname'];
			$array[$count]['Address'] = $row['Address'];
			$array[$count]['Phonenumber'] = $row['Phonenumber'];
			$count++;
		}  
		return $array;
	}
	public function getAccountAddressByID($conn, $id)
	{
		$sql = "SELECT * FROM address WHERE ID=?;";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		$array = array();
		while ($row = $result->fetch_assoc())
		{	
			$array['ID'] = $row['ID'];
			$array['IDUser'] = $row['IDUser'];
			$array['Fullname'] = $row['Fullname'];
			$array['Address'] = $row['Address'];
			$array['Phonenumber'] = $row['Phonenumber'];
		}  
		return $array;
	}

	function getRandomString( int $length = 16, string $keyspace = '0123456789abcde'): string 
	{
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
		$pieces = [];
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$pieces []= $keyspace[random_int(0, $max)];
		}
		return implode('', $pieces);
	}
	function checkPassword($email,$password,$conn) {
	  $a=mysqli_query($conn,"SELECT Password FROM users WHERE Email = '$email'");
	  if(mysqli_num_rows($a) == 1 ) {
		$password_info=mysqli_fetch_array($a);
		$sha_info = explode("$",$password_info[0]);
	  } else 
		return false;
	  if( $sha_info[1] === "SHA" ) {
		$salt = $sha_info[2];
		$sha256_password = hash('sha256', $password);
		$sha256_password .= $sha_info[2];;
		if( strcasecmp(trim($sha_info[3]),hash('sha256', $sha256_password) ) == 0 ) 
		  return true;
		else return false;
	  }
	}

	function hideEmail($email)
	{
	if(filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		list($first, $last) = explode('@', $email);
		$first = str_replace(substr($first, '1'), str_repeat('*', strlen($first)-3), $first);
		$last = explode('.', $last);
		$last_domain = str_replace(substr($last['0'], '1'), str_repeat('*', strlen($last['0'])-1), $last['0']);
		$hideEmail = $first.'@'.$last_domain.'.'.$last['1'];
		return $hideEmail;
	}
	}
	function converttime($date)
	{
		$datechange = $date;
		$timeEng = ['Sun','Mon','Tue','Wed', 'Thu', 'Fri', 'Sat', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
		$timeVie = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy','Một', 'Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy', 'Tám', 'Chín', 'Mười', 'Mười Một', 'Mười Hai'];
		$unixtime_to_date = date('D, \N\g\à\y d \T\h\á\n\g M \N\ă\m Y ,H \G\i\ờ i \P\h\ú\t', $datechange);
		$time = str_replace( $timeEng, $timeVie, $unixtime_to_date);
		return $time;
	}
	function converttimedate($date)
	{
		$datechange = $date;
		$unixtime_to_date = date('d/m/Y', $datechange);
		return $unixtime_to_date;
	}
	function checkPhoneNumber($phonenumber)
	{
		return preg_match('/^[0-9]{10}+$/', $phonenumber);	
	}
	function checkTOTP($username,$conn)
	{
		$sql = "SELECT * FROM users WHERE Username=?;";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$username);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$check = $row['totp'];
		if($check==null)
		{
			return false;
		}
		if($check!=null)
		{
			return true;
		}
	}
}


?>