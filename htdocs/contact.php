<?php
	session_start();
	$role = $_SESSION["roleUser"];
	$idUser = $_SESSION['idUser'];
	if(empty($_SESSION['idUser'])) 
		header("Location:index.php");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Contact</title>
<link rel="stylesheet" href="css/animate.css"/>
<link rel="stylesheet" href="css/style.css"/>
<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>

</head>


<body>
<div id="fh5co-wrap">
		<header id="fh5co-header">
			<div class="container">
				<nav class="fh5co-main-nav">
					<ul>
						<li><a href="GetAHome.php"><span>Home</span></a></li>
						<li><a href="createHousing.php"><span>Create Housing</span></a></li>
						<li><a href="contact.php"><span>Contact</span></a></li>
						<?php
							if($role == "2" || $role == "3"){
								echo "<li><a href='manageHousing.php'><span>Housing Management</span></a></li>";
								echo "<li><a href='manageUser.php'><span>User Management</span></a></li>";
							}
						?>
						<li><a href="deconnection.php"><span>Deconnection</span></a></li>
					</ul>
				</nav>
			</div>
		</header>

		<div class="fh5co-hero" style="background-image: url(images/background.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="center-title">
					<div class="text-center fh5co-table">
						<div class="fh5co-intro fh5co-table-cell">
							<h1>Contact</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	<script src="js/GetAHome.js"></script>

	</body>

	Work in Progress
		
</html>
