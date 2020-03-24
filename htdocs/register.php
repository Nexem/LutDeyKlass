<?php
	session_start();
	$role = "user";
?>

<?php

	date_default_timezone_set('asia/kuala_lumpur');

	if(isset($_POST['register']))
	{
		$conn = mysqli_connect('localhost','root','','getahome');
		$idUser = $_POST['id'];
		$pwdUser = $_POST['pwd'];
		$pwd = md5($pwdUser,TRUE);
		$firstnameUser = $_POST['firstname'];
		$lastnameUser = $_POST['lastname'];
		$emailUser = $_POST['email'];
		$phoneUser = $_POST['phone'];
		$mailingUser = $_POST['address'];	
	
		if($idUser == "" || $pwdUser == "" || $firstnameUser == "" || $lastnameUser == "" 
		|| $emailUser == "" || $phoneUser == "" || $mailingUser == "")
		{
			die("Please enter all informations first to register !");	
		}
		
		$sql = "INSERT INTO user (id,login,pwd,firstname,lastname,email,phone,mailing,role,Last_Login,idHousing) VALUES (NULL,'".$idUser."','"
		.$pwd."','".$firstnameUser."','".$lastnameUser."','".$emailUser."','"
		.$phoneUser."','".$mailingUser."','1','" .date("Y-m-d H:i:s")."','0');";
		//echo $sql;
		if(mysqli_query($conn, $sql)){
			mysqli_close($conn);	
			header("Location:index.php");
		}
		else{
			echo "Failed to create the user";
		}
	}	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Register</title>
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
				<form  method="post" action="register.php">
					<span class="login100-form-title p-b-26">
						Register 					</span>
					
						<div class="wrap-input100 validate-input" data-validate = "Enter ID">
							<input class="input100" type="text" name="id"/>
							<span class="focus-input100" data-placeholder="Login"></span>
						</div>
	
						<div class="wrap-input100 validate-input" data-validate="Enter password">
							<span class="btn-show-pass">
								<i class="zmdi zmdi-eye"></i>
							</span>
							<input class="input100" type="password" name="pwd"/>
							<span class="focus-input100" data-placeholder="Password"></span>
						</div>
						
						<div class="wrap-input100 validate-input" data-validate = "Enter First Name">
							<input class="input100" type="text" name="firstname"/>
							<span class="focus-input100" data-placeholder="First Name"></span>
						</div>

						<div class="wrap-input100 validate-input" data-validate = "Enter Last Name">
							<input class="input100" type="text" name="lastname"/>
							<span class="focus-input100" data-placeholder="Last Name"></span>
						</div>
						
						<div class="wrap-input100 validate-input" data-validate = "Enter Email">
							<input class="input100" type="text" name="email"/>
							<span class="focus-input100" data-placeholder="Email address"></span>
						</div>

						<div class="wrap-input100 validate-input" data-validate = "Enter Phone Number">
							<input class="input100" type="text" name="phone"/>
							<span class="focus-input100" data-placeholder="Phone Number"></span>
						</div>

						<div class="wrap-input100 validate-input" data-validate = "Enter Address">
							<input class="input100" type="text" name="address"/>
							<span class="focus-input100" data-placeholder="Mailing address"></span>
						</div>


	
						<input type="submit" value="Register" name="register"/>

					<div class="text-center p-t-115">
						<span class="txt1">
							Already have an account?
						</span>

						<a class="txt2" href="index.php">
							Connection
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	
	
	<div id="dropDownSelect1"></div>
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>

	
	
</body>

</html>
