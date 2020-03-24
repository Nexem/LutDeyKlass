<?php
	session_start();
	$roleUser = "";
	$idUser="";
	$idHousing="";
?>

<?php
	unset($_SESSION['roleUser']);
	unset($_SESSION['idUser']);
	unset($_SESSION['idHousing']);	

	if(isset($_POST['loginUser']))
	{	
		$conn = mysqli_connect('https://2892961.admin.sd5.gpaas.net/','root','','boribote');
		$idUser = $_POST['loginUser'];
		$pwdUser = $_POST['pwd'];
		$pwd = md5($pwdUser,TRUE);
	
		if($idUser == "" || $pwdUser == "")
		{
			die("Please enter your id's first before the submit!");	
		}
		
		$sqlUser = "SELECT * FROM user WHERE login = '".$idUser."' AND password = '".$pwd."'";
		
		$loginUser = $conn->query($sqlUser);
		if(mysqli_num_rows($loginUser) == 1)
		{
			$row = $loginUser->fetch_assoc();
			$_SESSION['roleUser'] = $row['role']; 
			$_SESSION['idUser'] = $row['id'];	
			$_SESSION['idHousing'] = $row['idHousing'];			
			header("Location:homepage.php");
		}
		else {
			echo "Sorry, wrong login IDs, try again";
			header("Refresh:0");
		}
	}	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css"/>
<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css"/>
<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css"/>
<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css"/>
<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css"/>
<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css"/>
<link rel="stylesheet" type="text/css" href="css/util.css"/>
<link rel="stylesheet" type="text/css" href="css/main.css"/>

</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form  method="post" action="index.php">
					<span class="login100-form-title p-b-26">
						Welcome
					</span>
					
						<div class="wrap-input100 validate-input" data-validate = "Enter ID">
							<input class="input100" type="text" name="loginUser"/>
							<span class="focus-input100" data-placeholder="Login"></span>
						</div>
	
						<div class="wrap-input100 validate-input" data-validate="Enter password">
							<span class="btn-show-pass">
								<i class="zmdi zmdi-eye"></i>
							</span>
							<input class="input100" type="password" name="pwd"/>
							<span class="focus-input100" data-placeholder="Password"></span>
						</div>
	
						<input type="submit" value="Login" name="login"/>

					<div class="text-center p-t-115">
						<span class="txt1">
							Dont have an account?
						</span>

						<a class="txt2" href="register.php">
							Sign Up
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	
	
	<div id="dropDownSelect1"></div>
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
