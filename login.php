<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
	session_start();
	include 'conn.php';

		if(isset($_POST['login'])){
		if($_POST['voter'] != "" || $_POST['password'] != ""){
			$username = $_POST['voter'];
			$password = $_POST['password'];
			$sql = "SELECT * FROM `users` WHERE `username` =? AND `password`=? ";
			$query = $conn->prepare($sql);
			$query->execute(array($username,$password));
			$row = $query->rowCount();
			$fetch = $query->fetch();

                        
			if($row > 0) {
				$_SESSION['voter'] = $fetch['user_id'];
				header("location: index.php");
			} else{
			$_SESSION['error'] = 'Wrong details Access Denied';
			header("location: index.php");
			}
		}else{
			$_SESSION['error'] = 'All fields required';
			header("location: index.php");
			
		}
	}

?>



</body>
</html>
