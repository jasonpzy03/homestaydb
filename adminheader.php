<!DOCTYPE html>
<html>
<head>
	<title>Admin | Homestay Rumah JOHO</title>
	<link rel="stylesheet" type="text/css" href="prerequisite.css?v=4">
	<link rel="stylesheet" type="text/css" href="headerbar2.css?v=10">
	<link rel="stylesheet" type="text/css" href="dropdown.css?v=10">
	<link rel="stylesheet" type="text/css" href="admin4.css?v=4">
	<link rel="icon" href="img/logo.png">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script type="text/javascript" src="dropdown1.js"></script>
<body>

	<div class="headerbar">
		<div class="wrapper">
			<div class="logo">
				<img src="img/logo.png" alt="LOGO" title="	Rumah JOHO">
			</div>
			<div class="user" onclick="view()">
				<img id="pic" src="img/profilepics/<?php echo $_SESSION['pic'];?>">
				<?php 

					echo "<p>".$_SESSION['userUid']."</p>";

		 		?>
				<img id="dropdown" src="img/dropdown.png">
				<img id="bluedropdown" src="img/bluedropdown.png">
			</div>
		</div>
	</div>

	<div id="dropdownbox">
		<img src="img/profilepics/<?php echo $_SESSION['pic'];?>">
		<div class="userinfo">
			<?php 

				echo "<p>".$_SESSION['userUid']."</p>";
				echo "<p>".$_SESSION['mail']."</p>";

		 	?>
		</div>
		<form action="logout.php" method="POST">
			<button class="btn2 logoutbtn" type="submit" name="logout-submit">Logout</button>
		</form>
		<div class="border2"></div>
		<a class="btn2 functionbtn" href="manageaccountA.php">Manage Account</a>
	</div>