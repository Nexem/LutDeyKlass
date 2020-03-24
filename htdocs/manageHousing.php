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
<title>Manage Housing</title>

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
							<h1>Manage Housing</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	<script src="js/GetAHome.js"></script>

	</body>

<?php
	$conn = mysqli_connect('localhost','root','','getahome');
	$result = mysqli_query($conn,"SELECT * FROM housing");

	while($row = mysqli_fetch_array($result))
	{
		echo "<hr width='75%'><table>";
		echo "<tr><td>";
		echo "<div id='vignette'><img src='". $row['imagePath'] ."' width=300px height=200px/></div>";
		echo "</td><td>";
		echo "<div id='descrip'>";
		echo "<g><h2>&nbsp;	<u>". $row['name']."</u></h2></g>";
		echo "&nbsp;	Place: ". $row['place'] . "<br />";
		echo "&nbsp;	Price: ". $row['price'] ." RM<br />";
		echo "&nbsp;	Size: ". $row['size'] ." m²<br />";	
		echo "&nbsp;	Availability: ". $row['avaibility'] ."<br />";			
		echo "</td><td>";
		if($row['avaibility'] == "validation"){
			echo "<form method='post' action='manageHousing.php'>";
			echo "<input type='hidden' value='". $row['id'] ."' name='id'/>";
			echo "<input type='submit' value='Validate the Housing' name='validateHousing'/><br /><br />";			
			echo "</form>";
		}
		if($row['avaibility'] == "rent"){
			echo "<form method='post' action='manageHousing.php'>";
			echo "<input type='hidden' value='". $row['id'] ."' name='id'/>";
			echo "<input type='submit' value='Unrent the Housing' name='unrentHousing'/><br /><br />";			
			echo "</form>";
		}
		echo "<form method='post' action='manageHousing.php'>";
		echo "<input type='hidden' value='". $row['id'] ."' name='id'/>";
		echo "<input type='submit' value='Delete the Housing' name='delete'/><br /><br />";			
		echo "</form>";
		

		
		echo "</div>";
		echo "</td></tr> </table><br />";
						
	}
	echo "<hr width='75%'>";

	if(isset($_POST['validateHousing'])){
		$id = $_POST['id'];
		$sql = mysqli_query($conn,"UPDATE housing SET avaibility='available' WHERE id=". $id ."");
		header("Refresh:0");
	}
	
	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM housing WHERE id=". $id;
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
	   		header("Refresh:0");
		} else {
		    echo "Error deleting record: " . $conn->error;
		}		
	}
	
	if(isset($_POST['unrentHousing'])){
		$id = $_POST['id'];
		$sql = mysqli_query($conn,"UPDATE housing SET avaibility='available' WHERE id=". $id ."");
		$sqlUpdateId = mysqli_query($conn,"UPDATE housing SET idUserHousing='0' WHERE id=". $id ."");
		header("Refresh:0");
	}

?>



</html>
