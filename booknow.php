<?php 

	include("mysession.php");
	include("checkidforcustomer.php");
	require 'dbconnect.php';
	
	$sql = "SELECT IDRumah, NamaRumah, Alamat, HargaSehari, Booked, ImageName, Description FROM rumah";
	$result = mysqli_query($conn, $sql);
	$num_rows = mysqli_num_rows($result);
	$i = 1;

	while($row = mysqli_fetch_array($result)) {
		$ImageName[$i] = $row['ImageName'];
		$booked[$i] = $row['Booked'];
		$homestayID[$i] = $row['IDRumah'];
		$homestayName[$i] = $row['NamaRumah'];
		$address[$i] = $row['Alamat'];
		$price[$i] = $row['HargaSehari'];
		$desc[$i] = $row['Description'];
		$i++;
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Book Now | Homestay Rumah JOHO</title>
	<link rel="stylesheet" type="text/css" href="prerequisite.css?v=4">
	<link rel="stylesheet" type="text/css" href="sidebar.css?v=3">
	<link rel="stylesheet" type="text/css" href="headerbar.css?v=3">
	<link rel="stylesheet" type="text/css" href="footer.css?v=3">
	<link rel="stylesheet" type="text/css" href="dropdown.css?v=10">
	<link rel="stylesheet" type="text/css" href="booknow5.css?v=5">
	<link rel="icon" href="img/logo.png">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script type="text/javascript" src="dropdown1.js"></script>
<script type="text/javascript" src="sidebar.js"></script>
<?php 

	require 'header2.php';

 ?>
	<div class="wrapper2">
		<div class="content">
			<?php 

				if($num_rows > 0) {
					echo "<p class='smltitle'>Result >> ".$num_rows." homestay(s) found.</p>";
					for($n = 1; $n < $i; $n++) {
						echo "<div class='box'>
								<p class='price'>from RM ".$price[$n]." / night</p>
								<div class='smlbanner'>
									<img src='img/".$ImageName[$n]."'>
								</div>
								<div class='title'>
									<h4>".$homestayName[$n]."</h4>
								</div>
								<div class='address'>
									<p>".$address[$n]."</p4>
								</div>
								<div class='description'>
								<p>".$desc[$n]."</p>
								</div>";

						if($booked[$n] == "0") {
							echo "<a href='booking.php?&homestayID=".$homestayID[$n]."' class='btn bookbtn'>Book Now</a>
							</div>";
						} else {
							echo "<p id='bookedtxt'>BOOKED</p>
							</div>";
						}
								
					}
				} else {
					echo "<div class='nohomestay'>
							<img src='img/sad.png'>
							<h1>There are no homestays available at the moment.</h1>
						</div>";
				}
				
			?>
			
		</div>
	</div>

<?php 

	require 'footer.php';

 ?>