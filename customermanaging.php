<?php 

	include("mysession.php");
	require 'dbconnect.php';
	if(!isset($_GET['homestayID']) || !isset($_GET['bookingID'])) {
		header("Location: managebooking.php");
		exit();
	}
	$sql = "SELECT sewaan.IDSewaan, sewaan.IDRumah, rumah.IDRumah, rumah.NamaRumah, rumah.Alamat, rumah.HargaSehari, rumah.ImageName, rumah.Description FROM rumah, sewaan WHERE sewaan.IDRumah = rumah.IDRumah AND sewaan.IDPelanggan=? AND sewaan.IDSewaan=? AND sewaan.IDRumah=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: managebooking.php?error=sqlerror");
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "iii", $_SESSION['userId'], $_GET['bookingID'], $_GET['homestayID']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$checkResult = mysqli_num_rows($result);
		if($checkResult > 0) {
			while($row = mysqli_fetch_assoc($result)) {
			$ImageName = $row['ImageName'];
			$bookingid = $row['IDSewaan'];
			$homestayID = $row['IDRumah'];
			$homestayName = $row['NamaRumah'];
			$address = $row['Alamat'];
			$price = $row['HargaSehari'];
			$desc = $row['Description'];
		}
	} else {
		header("Location: managebooking.php");
		exit();
	}
	}
	
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Booking | Homestay Rumah JOHO</title>
<link rel="stylesheet" type="text/css" href="prerequisite.css?v=4">
	<link rel="stylesheet" type="text/css" href="inputstyle.css?v=3">
	<link rel="stylesheet" type="text/css" href="sidebar.css?v=3">
	<link rel="stylesheet" type="text/css" href="headerbar.css?v=3">
	<link rel="stylesheet" type="text/css" href="footer.css?v=2">
	<link rel="stylesheet" type="text/css" href="dropdown.css?v=10">
	<link rel="stylesheet" type="text/css" href="customermanaging5.css?v=7">
	<link rel="icon" href="img/logo.png">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script type="text/javascript" src="dropdown1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="sidebar.js"></script>

	<script type="text/javascript">
	function calculate() {
		var amountofdays = document.getElementById("amountofdays").value;
		var priceperday = <?php echo $price; ?>;
		var totalprice = amountofdays * priceperday;
		document.getElementById('pricetopay').innerHTML = "RM " + Math.round(totalprice);
		document.getElementById('totalprice').value = totalprice;
		
	}

	
</script>
<script type="text/javascript">

	function confirmationDelete() {

   		var conf = confirm('Are you sure want to delete this record?');
   		if(conf) {

     		 return true;
 		  } else {
 		  	return false;
 		  }
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
					<?php echo "<p>".$address."</p4>"; ?>
				</div>
				<div class='description'>
					<?php echo "<p>".$desc."</p>"; ?>
				</div>
			</div>
			<div class="booking">
				<?php echo "<h2>".$homestayName."</h2>"; ?>
				<div class="border"></div>
				<form action='customermanagingprocess.php?&homestayID=<?php echo $_GET["homestayID"]?>&bookingID=<?php echo $_GET["bookingID"]?>' method="POST" class="bookingform">
					<input type="text" name="toReceipt" value="true" style="display: none;">
					<p>Booking Date:</p>
					<input type="date" name="date" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d", strtotime("+1 years")); ?>">
					<p>Amount of days:</p>
					<input type="number" onKeyPress="if(this.value.length==3) return false;" onkeyup="calculate()" id="amountofdays" autocomplete="off" name="amountofdays" >
					<input type="text" style="display:none" id="totalprice" name="totalprice">
				<button onclick='return confirmationDelete();' class="removebooking" type="submit" name="remove-submit" method="POST" class="bookingform">Cancel Booking</button>
				<button type="submit" name="view-receipt-submit" class="viewreceipt">View Receipt</button>
				<div class="total">
					<p>Total:</p>
					<p id='pricetopay'>RM 0</p>
					<button class="btn updatebtn" type="submit" name="update-submit">Update</button>
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
			} 

			unset($_SESSION['error']);
		}

	 ?>
<?php 

	require 'footer.php';

 ?>