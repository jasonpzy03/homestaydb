<?php 

	include("mysession.php");
	include("checkidforcustomer.php");
	require 'dbconnect.php';
	if(!isset($_GET['homestayID'])) {
		header("Location: booknow.php");
		exit();
	}
	$sql = "SELECT NamaRumah, Alamat, HargaSehari, Booked, ImageName, Description FROM rumah WHERE IDRumah=?";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: booknow.php?error=sqlerror");
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "i", $_GET['homestayID']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$ImageName = $row['ImageName'];
				$booked = $row['Booked'];
				$homestayName = $row['NamaRumah'];
				$address = $row['Alamat'];
				$price = $row['HargaSehari'];
				$desc = $row['Description'];
			}
		} else {
			header("Location: booknow.php");
			exit();
		}
		

	}
	
	if($booked != '0') {
		header("Location: booknow.php?error=bookedhomestay");
		exit();
	}

	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Booking | Homestay Rumah JOHO</title>
	<link rel="stylesheet" type="text/css" href="prerequisite.css?v=4">
	<link rel="stylesheet" type="text/css" href="inputstyle.css?v=4">
	<link rel="stylesheet" type="text/css" href="sidebar.css?v=4">
	<link rel="stylesheet" type="text/css" href="headerbar.css?v=4">
	<link rel="stylesheet" type="text/css" href="footer.css?v=3">
	<link rel="stylesheet" type="text/css" href="dropdown.css?v=10">
	<link rel="stylesheet" type="text/css" href="booking9.css?v=7">
	<link rel="icon" href="img/logo.png">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script type="text/javascript" src="dropdown1.js"></script>
<script type="text/javascript" src="sidebar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
	function calculate() {
		var amountofdays = document.getElementById("amountofdays").value;
		var priceperday = <?php echo $price; ?>;
		var totalprice = amountofdays * priceperday;
		document.getElementById('pricetopay').innerHTML = "RM " + Math.round(totalprice);
		document.getElementById('totalprice').value = totalprice;
		
	}

	function removeSigns() {
	    var input = document.getElementById('amountofdays');
	    input.value = parseInt(input.value.toString().replace('+', '').replace('-', ''))
	}
	
</script>
<?php 

	require 'header2.php';

 ?>
	<div class="wrapper2">
		<div class="content">
			<div class="box">
				<?php echo "<p class='price'>from RM ".$price." / night</p>"; ?>
				<div class="smlbanner">
					<?php echo "<img src='img/".$ImageName."'>'"; ?>
				</div>
				<div class='title'>
					<?php echo "<h4>".$homestayName."</h4>"; ?>
				</div>
				<div class='address'>
					<?php echo "<p>".$address."</p>"; ?>
				</div>
				<div class='description'>
					<?php echo "<p>".$desc."</p>"; ?>
				</div>

			</div>
			<div class="booking">
				<?php echo "<h2>".$homestayName."</h2>"; ?>
				<div class="border"></div>
				<form action='bookingprocess.php?&homestayID=<?php echo $_GET["homestayID"]?>' method="POST" class="bookingform">
					<p>Booking Date:</p>
					<input type="date" name="date" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d", strtotime("+1 years")); ?>">
					<p>Amount of days:</p>
					<input min="0" step="1" type="number" onKeyPress="if(this.value.length==3) return false; removeSigns();"  onkeyup="calculate()" id="amountofdays" autocomplete="off" name="amountofdays" >
					<input type="text" style="display:none" id="totalprice" name="totalprice">
				
				<div class="total">
					<p>Total:</p>
					<p id='pricetopay'>RM 0</p>
					<button class="btn bookbtn" type="submit" name="book-submit">Book</button>
				</div>
				</form>
			</div>
		</div>
	</div>
<div class="alert2 a1">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Error!</strong> Please fill in the blanks.
</div>

<div class="alert2 a2">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Error!</strong> Please contact website admin.
</div>

<div class="alert2 a3">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Error!</strong> Please try again with valid inputs.
</div>

<div class="alert2 a4">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Error!</strong> Please try again with valid inputs.
</div>
	<?php 

		if(isset($_SESSION['error'])) {
			if($_SESSION['error'] == "emptyfields") {
				echo '<script language="javascript">';
				echo '$(".a1").css("display", "block")';
				echo '</script>';
			} else if($_SESSION['error'] == "sqlerror") {
				echo '<script language="javascript">';
				echo '$(".a2").css("display", "block")';
				echo '</script>';
			} else if($_SESSION['error'] == "calculationerror") {
				echo '<script language="javascript">';
				echo '$(".a3").css("display", "block")';
				echo '</script>';
			} else if($_SESSION['error'] == "invaliddays") {
				echo '<script language="javascript">';
				echo '$(".a4").css("display", "block")';
				echo '</script>';
			} 
			unset($_SESSION['error']);
		}

	 ?>

<?php 

	require 'footer.php';

 ?>