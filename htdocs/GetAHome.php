<?php
	session_start();
	$role = $_SESSION["roleUser"];
	$idUser = $_SESSION['idUser'];
	if(empty($_SESSION['idUser'])) 
		header("Location:index.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>GetAHome &mdash; Free HTML5 Bootstrap Website Template by FreeHTML5.co</title>

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
						<li><a href="deconnection.php"><span>Disconnection</span></a></li>
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
							<h1>Get A Home</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	<script src="js/GetAHome.js"></script>

	</body>
</html>

<?php
	$conn = mysqli_connect('localhost','root','','getahome');
	$result = mysqli_query($conn,"SELECT * FROM housing");

	while($row = mysqli_fetch_array($result))
	{
		if($row['avaibility'] == "available"){
			echo "<hr width='75%'><table>";
			echo "<tr><td>";
			echo "<div id='vignette'><img src='". $row['imagePath'] ."' width=300px height=200px/></div>";
			echo "</td><td>";
			echo "<div id='descrip'>";
			echo "<g><h2>&nbsp;	<u>". $row['name']."</u></h2></g>";
			echo "&nbsp;	Place: ". $row['place'] . "<br />";
			echo "&nbsp;	Price: ". $row['price'] ." RM<br />";
			echo "&nbsp;	Size: ". $row['size'] ." m²<br />";
			
			echo "<form method='post' action='GetAHome.php'>";
			echo "<input type='hidden' value='". $row['id'] ."' name='id'/>";
			echo "<input type='submit' value='rent' name='rent'/>";			
			echo "</form>";			
			echo "</div>";
			echo "</td></tr> </table><br />";
		}			
	}
	echo "<hr width='75%'>";
	
	if(isset($_POST['rent'])){
		$rentID = $_POST['id'];
		$rentHousing = mysqli_query($conn,"UPDATE housing SET avaibility='rent' WHERE id=". $rentID ."");
		$userAssociateHousing = mysqli_query($conn,"UPDATE user SET idHousing='".$rentID."' WHERE id=". $idUser ."");
		$HousingAssociateUser = mysqli_query($conn,"UPDATE housing SET idUserHousing='".$idUser."' WHERE id=".$rentID);
		header("Refresh:0");
	}
	
	mysqli_close($conn);
?>

