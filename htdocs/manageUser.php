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
<title>Manage User</title>
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
							<h1>Manage User</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	<script src="js/GetAHome.js"></script>

	</body>

<?php
	$conn = mysqli_connect('localhost','root','','getahome');
	$result = mysqli_query($conn,"SELECT * FROM user");

	while($row = mysqli_fetch_array($result))
	{
		echo "<hr width='75%'><table>";
		echo "<tr><td>";
		echo "<div id='descrip'>";
		echo "<g><h3>&nbsp;	<u>". $row['login']."</u></h3></g>";
		echo "&nbsp;	First name: ". $row['firstname'] . "<br />";
		echo "&nbsp;	Last name: ". $row['lastname'] ."<br />";
		echo "&nbsp;	Email: ". $row['email'] ."<br />";
		echo "&nbsp;	Phone number: ". $row['phone'] ."<br />";
		echo "&nbsp;	Mailing address: ". $row['mailing'] ."<br />";
		echo "</td><td>";
		echo "<form method='post' action='manageUser.php'>";
		echo "<input type='hidden' value='". $row['id'] ."' name='id'/>";
		echo "<input type='submit' value='Delete User' name='delete'/><br /><br />";			
		echo "</form>";
		
		if($role == "3"){
			if($row['role'] == 1){
				echo "<form method='post' action='manageUser.php'>";
				echo "<input type='hidden' value='". $row['id'] ."' name='id'/>";
				echo "<input type='submit' value='Promote to Modo' name='promote'/><br /><br />";			
				echo "</form>";
			}
			
			if($row['role'] == 2){
				echo "<form method='post' action='manageUser.php'>";
				echo "<input type='hidden' value='". $row['id'] ."' name='id'/>";
				echo "<input type='submit' value='Demote to user' name='demote'/><br /><br />";			
				echo "</form>";
			}
		}
		
		echo "</div>";
		echo "</td></tr> </table><br />";
				
	}
	echo "<hr width='75%'>";

	if(isset($_POST['promote'])){
		$id = $_POST['id'];
		$sql = mysqli_query($conn,"UPDATE user SET role='2' WHERE id=". $id ."");
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
	   		header("Refresh:0");
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}		

	
	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM user WHERE id=". $id;
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
	   		header("Refresh:0");
		} else {
		    echo "Error deleting record: " . $conn->error;
		}		
	}
	
	if(isset($_POST['demote'])){
		$id = $_POST['id'];
		$sql = mysqli_query($conn,"UPDATE user SET role='1' WHERE id=". $id ."");
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
	   		header("Refresh:0");
		} else {
		    echo "Error deleting record: " . $conn->error;
		}	
	}
	
			

?>

</html>
