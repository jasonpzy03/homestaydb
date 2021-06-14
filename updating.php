<?php 

	include("mysession.php");
	include("checkidforadmin.php");
	require 'dbconnect.php';
	if(!isset($_GET['homestayID'])) {
		header("Location: updatehomestay.php");
		exit();
	}
	$sql = "SELECT NamaRumah, Alamat, HargaSehari, ImageName, Description FROM rumah WHERE IDRumah=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		$_SESSION['error'] = "sqlerror";
		header("Location: updatehomestay.php");
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "i", $_GET['homestayID']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$checkResult = mysqli_num_rows($result);
		if($checkResult > 0) {
			while($row = mysqli_fetch_array($result)) {
				$ImageName = $row['ImageName'];
				$homestayName = $row['NamaRumah'];
				$address = $row['Alamat'];
				$price = $row['HargaSehari'];
				$desc = $row['Description'];
			}
	} else {
		header("Location: updatehomestay.php");
		exit();
	}
	}
	
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Update | Homestay Rumah JOHO</title>
<link rel="stylesheet" type="text/css" href="prerequisite.css?v=4">
		<link rel="stylesheet" type="text/css" href="inputstyle.css?v=11">
	<link rel="stylesheet" type="text/css" href="headerbar2.css?v=3">
	<link rel="stylesheet" type="text/css" href="updating7.css?v=8">
	<link rel="icon" href="img/logo.png">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to delete this record?');
   if(conf) {

      return true;
   } else {
   	return false;
   }
}
	</script>
</head>
<?php 

	require 'adminheader3.php';

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
			<div class="update">
				<?php echo "<h2>".$homestayName."</h2>"; ?>
				<div class="border"></div>
				<form action='updateprocess.php?&homestayID=<?php echo $_GET["homestayID"]?>' method="POST" class="updateform">
					
					<div class="txtb">
						<input type="text" name="homestayname" autocomplete="off" value="<?php if(isset($_SESSION['homestayName'])) {echo $_SESSION['homestayName'];}else {
						echo $homestayName;}?>" maxlength="50">
						<span data-placeholder="New Homestay Name"></span>
						<p class='errormsg errormsgname'>Homestay name already exists.</p>
						<p class='errormsg errormsgname2'>Invalid homestay name.</p>
						<p class='errormsg errormsg1'>This field is required.</p>
						<div class='errorline'></div>
					</div>

					<div class="txtb">
						<input type="text" name="address" autocomplete="off" value="<?php if(isset($_SESSION['address'])) {echo $_SESSION['address'];}else {
						echo $address;}?>" maxlength="100">
						<span data-placeholder="New Address"></span>
						<p class='errormsg errormsgaddress'>Invalid homestay address.</p>
						<p class='errormsg errormsg1'>This field is required.</p>
						<div class='errorline'></div>
					</div>

					<div class="txtb">
						<input type="number" name="price" autocomplete="off" value="<?php if(isset($_SESSION['priceperday'])) {echo $_SESSION['priceperday'];}else {
						echo $price;}?>" onKeyPress="if(this.value.length==10) return false;">
						<span data-placeholder="New price per day"></span>
						<p class='errormsg errormsgprice'>Invalid price.</p>
						<p class='errormsg errormsg1'>This field is required.</p>
						<div class='errorline'></div>
					</div>

					<div class="txtb">
						<input type="text" name="imagename" autocomplete="off" value="<?php if(isset($_SESSION['imagename'])) {echo $_SESSION['imagename'];}else {
						echo $ImageName;}?>" maxlength="20"> 
						<span data-placeholder="New image name"></span>
						<p class='msg'>Format: banner[1 ~ 15].jpg.</p>
						<p class='errormsg errormsgimgname'>Invalid image.</p>
						<p class='errormsg errormsg1'>This field is required.</p>
						<div class='errorline'></div>
					</div>
					<div class="txtb">
						<input type="text" name="description" autocomplete="off" value="<?php if(isset($_SESSION['description'])) {echo $_SESSION['description'];}else {
						echo $desc;}?>" maxlength="100">
						<span data-placeholder="New description"></span>
						<p class='errormsg errormsgdesc'>Invalid description.</p>
						<p class='errormsg errormsg1'>This field is required.</p>
						<div class='errorline'></div>
					</div>
					<button onclick='return confirmationDelete($(this));' class="removehomestay" type="submit" name="removehomestay-submit">Remove Homestay</button>
					<button class="btn updatebtn" type="submit" name="updatehomestay-submit">Update</button>
				</form>
			</div>
		</div>
	</div>

	<div class="alert2 a1">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Error!</strong> Please fill in the blanks.
</div>

<div class="alert a2">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Success!</strong> Homestay has been updated.
</div>

<div class="alert2 a3">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Error!</strong> Please contact website admin.
</div>

<script type="text/javascript" src="inputstyle.js?v=11"></script>

<?php 

		if(isset($_SESSION['error'])) {
			if($_SESSION['error'] == "emptyfields") {
				echo '<script language="javascript">';
				echo '$(".txtb input").each(function() {

			if($(this).val() == "") {
				$(this).parent().find(".errormsg1").css("display", "block");
				$(this).parent().find(".errorline").css("display", "block");
			}
		});';
				echo '</script>';
			} else if($_SESSION['error'] == "invalidname") {
				echo '<script language="javascript">';
				echo '$(".txtb input").each(function() {

				
					if($(this).parent().find(".errormsgname2").length) {
						$(this).val("");
						$(this).parent().find(".errormsgname2").css("display", "block");
						$(this).parent().find(".errorline").css("display", "block");
					}
				
				
				
			
		});';
				echo '</script>';
			} else if($_SESSION['error'] == "invalidaddress") {
				echo '<script language="javascript">';
				echo '$(".txtb input").each(function() {

				
					if($(this).parent().find(".errormsgaddress").length) {
						$(this).val("");
						$(this).parent().find(".errormsgaddress").css("display", "block");
						$(this).parent().find(".errorline").css("display", "block");
					}
				
				
				
			
		});';
				echo '</script>';
			} else if($_SESSION['error'] == "invalidprice") {
				echo '<script language="javascript">';
				echo '$(".txtb input").each(function() {

				
					if($(this).parent().find(".errormsgprice").length) {
						$(this).val("");
						$(this).parent().find(".errormsgprice").css("display", "block");
						$(this).parent().find(".errorline").css("display", "block");
					}
				
				
				
			
		});';
				echo '</script>';
			} else if($_SESSION['error'] == "invalidimgname") {
				echo '<script language="javascript">';
				echo '$(".txtb input").each(function() {

				
					if($(this).parent().find(".errormsgimgname").length) {
						$(this).val("");
						$(this).parent().find(".errormsgimgname").css("display", "block");
						$(this).parent().find(".errorline").css("display", "block");
					}
				
				
				
			
		});';
				echo '</script>';
			} else if($_SESSION['error'] == "invaliddesc") {
				echo '<script language="javascript">';
				echo '$(".txtb input").each(function() {

				
					if($(this).parent().find(".errormsgdesc").length) {
						$(this).val("");
						$(this).parent().find(".errormsgdesc").css("display", "block");
						$(this).parent().find(".errorline").css("display", "block");
					}
				
				
				
			
		});';
				echo '</script>';
			} else if($_SESSION['error'] == "sqlerror") {
				echo '<script language="javascript">';
				echo '$(".a3").css("display", "block")';
				echo '</script>';
			} else if($_SESSION['error'] == "nametaken") {
				echo '<script language="javascript">';
				echo '$(".txtb input").each(function() {

			
				if($(this).parent().find(".errormsgname").length) {
					$(this).val("");
					$(this).parent().find(".errormsgname").css("display", "block");
					$(this).parent().find(".errorline").css("display", "block");
				}
				
			
		});';
				echo '</script>';
			}
			unset($_SESSION['error']);
			unset($_SESSION['address']);
			unset($_SESSION['priceperday']);
			unset($_SESSION['imagename']);
			unset($_SESSION['description']);
			unset($_SESSION['homestayName']);
		} 

		if(isset($_SESSION['update'])) {
			if($_SESSION['update'] == "success") {
				echo '<script language="javascript">';
				echo '$(".a2").css("display", "block")';
				echo '</script>';
			}
			unset($_SESSION['update']);
			unset($_SESSION['address']);
			unset($_SESSION['priceperday']);
			unset($_SESSION['imagename']);
			unset($_SESSION['description']);
			unset($_SESSION['homestayName']);
		}

	 ?>
	
</body>
</html>