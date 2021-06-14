<?php 

	include("mysession.php");
	include("checkidforadmin.php");
	require 'dbconnect.php';
	$sql = "SELECT IDRumah, NamaRumah, Alamat, HargaSehari, ImageName, Description FROM rumah";
	$result = mysqli_query($conn, $sql);
	$num_rows = mysqli_num_rows($result);
	$i = 1;
	while($row = mysqli_fetch_array($result)) {
		$ImageName[$i] = $row['ImageName'];
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
	<title>Update | Homestay Rumah JOHO</title>
<link rel="stylesheet" type="text/css" href="prerequisite.css?v=4">
	<link rel="stylesheet" type="text/css" href="inputstyle.css?v=5">
	<link rel="stylesheet" type="text/css" href="headerbar2.css?v=3">
	<link rel="stylesheet" type="text/css" href="updatehomestay4.css?v=6">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="img/logo.png">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<?php 

	require 'adminheader2.php';

 ?>

	<div class="title">
		<h1>Update Homestay</h1>

		<div class="title2">
			<p>Choose which homestay to update</p>
		</div>
	</div>

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
								</div>
								<a href='updating.php?&homestayID=".$homestayID[$n]."' class='btn updatebtn'>Update</a>
							</div>";
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

	<div class="alert a1">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Success!</strong> Homestay has been removed.
</div>
<div class="alert2 a2">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Error!</strong> Please contact website admin.
</div>

<script type="text/javascript" src="inputstyle.js"></script>

<?php 
	
	if(isset($_SESSION['error'])) {
		if($_SESSION['error'] == "sqlerror") {
			echo '<script language="javascript">';
				echo '$(".a2").css("display", "block")';
				echo '</script>';
			
		}
		unset($_SESSION['error']);
	}
if(isset($_SESSION['remove']) && $_SESSION['remove'] == "success") {
				echo '<script language="javascript">';
				echo '$(".a1").css("display", "block")';
				echo '</script>';
				unset($_SESSION['remove']);
			}

 ?>
	
</body>
</html>