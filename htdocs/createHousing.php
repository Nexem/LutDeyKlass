<?php
	session_start();
	$role = $_SESSION["roleUser"];
	$idUser = $_SESSION['idUser'];
	if(empty($_SESSION['idUser'])) 
		header("Location:index.php");
?>

<?php
	if(isset($_POST['submit']))
	{
		$conn = mysqli_connect('localhost','root','','getahome');
		$nameHousing = $_POST['name'];
		$placeHousing = $_POST['place'];
		$priceHousing = $_POST['price'];
		$sizeHousing = $_POST['size'];
				
		$target_dir = "uploads/";
		$image = $target_dir . basename($_FILES["ImageToUpload"]["name"]);
			
	    $check = getimagesize($_FILES["ImageToUpload"]["tmp_name"]);
	    if($check !== false) {
			if (move_uploaded_file($_FILES["ImageToUpload"]["tmp_name"], $image)) {
			    echo "The file ". basename( $_FILES["ImageToUpload"]["name"]). " has been uploaded.";
			} else {
			    echo "Sorry, there was an error uploading your file.";
			}
	    } else {
	    	echo "Sorry, your file was not uploaded.";
	    }

		if($nameHousing == "" || $placeHousing == "" || $priceHousing == "" || $sizeHousing == "")
		{
			die("Please enter all the information required before the submit! Please retry");	
		}
		
		if($role == "1") {
			$sql = "INSERT INTO housing (name,place,price,size,avaibility,imagePath,idUserHousing) VALUES ('".$nameHousing."','".$placeHousing."','".$priceHousing."','".$sizeHousing."','validation','".$image."','0')";
		}
		else{
			$sql = "INSERT INTO housing (name,place,price,size,avaibility,imagePath,idUserHousing) VALUES ('".$nameHousing."','".$placeHousing."','".$priceHousing."','".$sizeHousing."','available','".$image."','0')";
		}
			
		if(mysqli_query($conn, $sql)){
			echo "Housing successfully created !";
			header("Location:GetAHome.php");
		}
		else{
			echo "Failed to create the housing, SQL ERROR, please retry or contact staff member";
			header("Refresh:0");
		}		
	}	
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="GetAHome.css"/>
<title>Create housing</title>
</head>


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
							<h1>Create Housing</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	<script src="js/GetAHome.js"></script>

	</body>

		<table>
			<form method="post" action="createHousing.php" enctype="multipart/form-data">
				<tr><td>Housing categorie (House / Appartment ...): </td><td><input type="text" value="" name="name"/></td></tr>
				<tr><td>Place of the housing: </td><td><input type="text" value="" name="place"/></td></tr>
				<tr><td>Price of the housing: </td><td><input type="text" value="" name="price"/></td></tr>
				<tr><td>Size of the housing: </td><td><input type="text" value="" name="size"/></td></tr>
				<tr><td>Select image to upload :</td><td><input type="file" name="ImageToUpload" id="fileToUpload"></td></tr>
				<tr><td><input type="submit" value="Create Housing" name="submit"/></td></tr>
			</form>
		</table>
	</div>

</body>

</html>