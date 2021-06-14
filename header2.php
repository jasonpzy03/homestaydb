
<body>
	<nav class="headerbar">
		<div class="wrapper">
			<div class="logo">
				<a href="customer.php#home"><img src="img/logo.png" alt="LOGO" title="Rumah JOHO"></a>
			</div>
			<div class="main-nav">
				<ul>
					<li><a href="customer.php#home">Home</a></li>
					<li><a href="booknow.php">Book Now</a></li>
					<li><a href="customer.php#gallery">Gallery</a></li>
					<li><a href="customer.php#aboutncontact">About</a></li>
				</ul>
			</div>
			<div class="user" onclick="view()">
				<img id="pic" src="img/profilepics/<?php echo $_SESSION['pic'];?>">
				<?php 
					echo "<p>".$_SESSION['userUid']."</p>";


		 		?>
				<img id="dropdown" src="img/dropdown.png">
				<img id="bluedropdown" src="img/bluedropdown.png">
			</div>
			<div class="cta">
				<img id="bar" src="img/category.png" onclick="showBar()">
			</div>
		</div>
	</nav>

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
		<a class="btn2 functionbtn" href="managebooking.php">Manage Booking(s)</a>
		<a class="btn2 functionbtn" href="manageaccount.php">Manage Account</a>
	</div>

	 <div id="sidebar">
		<img id="xbar" src="img/cross.png" onclick="closeBar()">
		<ul>
					<li><a href="customer.php#home">Home</a></li>
					<li><a href="booknow.php">Book Now</a></li>
					<li><a href="customer.php#gallery">Gallery</a></li>
					<li><a href="customer.php#aboutncontact">About</a></li>
					<li><a href="customer.php#aboutncontact">Contact</a></li>
				</ul>
			
			
	</div>