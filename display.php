<?php 

	include("mysession.php");
	include("checkidforadmin.php");
	require 'dbconnect.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Display | Homestay Rumah JOHO</title>
<link rel="stylesheet" type="text/css" href="prerequisite.css?v=4">
		<link rel="stylesheet" type="text/css" href="inputstyle.css?v=4">
	<link rel="stylesheet" type="text/css" href="headerbar2.css?v=3">
	<link rel="stylesheet" type="text/css" href="display4.css?v=6">
	<link rel="icon" href="img/logo.png">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			if($(".errorline").css("display") == "block") {
				$("#selectBox").css("border", "none");
			}
		});
	</script>
</head>
<?php 

	require 'adminheader2.php';

 ?>

	<div class="title">
		<h1>Display</h1>

		<div class="title2">
			<p>Choose which homestay to display</p>
		</div>
	</div>

	<div class="content">
		
		<form action="displayprocess.php" method="post">
			
			<select name="homestayID" id="selectBox" placeholder="hi">
				<option value="0" disabled selected hidden>Select HomestayID</option>
				<?php 

				$sql = "SELECT IDRumah FROM rumah";
				$result = mysqli_query($conn, $sql);

				while($row = mysqli_fetch_assoc($result)) {
					echo "<option value='".$row['IDRumah']."'>".$row['IDRumah']."</option>";
				}

				 ?>
			</select>
			<p class='errormsg errormsg1'>This field is required.</p>
				<div class='errorline'></div>

			<button type="submit" class="btn2 displaybtn" name="display-submit">Display</button>
		</form>
		
	</div>

	<div class="alert a1">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Error!</strong> Please contact website admin.
</div>

<?php 

		if(isset($_SESSION['error'])) {
			if($_SESSION['error'] == "emptyfields") {
				echo '<script language="javascript">';
				echo '
					$(".errormsg1").css("display", "block");
				$(".errorline").css("display", "block");
				';
				echo '</script>';
			}else if($_SESSION['error'] == "sqlerror") {
				echo '<script language="javascript">';
				echo '$(".a1").css("display", "block")';
				echo '</script>';
			}  

			unset($_SESSION['error']);
		}

	 ?>
	
</body>
</html>