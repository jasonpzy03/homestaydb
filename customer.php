<?php 

	include("mysession.php");
	include("checkidforcustomer.php");
	require 'dbconnect.php';
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$sql = "SELECT sewaan.IDRumah, rumah.IDRumah, sewaan.TarikhAkhir FROM sewaan, rumah WHERE sewaan.IDRumah = rumah.IDRumah";
	$result = mysqli_query($conn, $sql);
	$i = 0;
	while($row = mysqli_fetch_assoc($result)) {
		$homestayID[$i] = $row['IDRumah'];
		$enddate[$i] = $row['TarikhAkhir'];
		$i++;
	}

	
	for($n = 0; $n < $i; $n++) {
		if(date("Y-m-d") == $enddate[$n]) {
			$sql3 = "DELETE FROM sewaan WHERE IDRumah =".$homestayID[$n];
			$sql2 = "UPDATE rumah SET Booked='0' WHERE IDRumah=".$homestayID[$n];
			mysqli_query($conn, $sql2);
			mysqli_query($conn, $sql3);
		}
		
	}
 ?>

 <!DOCTYPE html>
<html>
<head>
	<title>Homestay Rumah JOHO</title>
<link rel="stylesheet" type="text/css" href="prerequisite.css?v=4">
	<link rel="stylesheet" type="text/css" href="sidebar.css?v=4">
	<link rel="stylesheet" type="text/css" href="homepagecontent1.css?v=10">
	<link rel="stylesheet" type="text/css" href="headerbar.css?v=5">
	<link rel="stylesheet" type="text/css" href="footer.css?v=2">
	<link rel="stylesheet" type="text/css" href="dropdown.css?v=6">
	<link rel="stylesheet" type="text/css" href="customer9.css?v=5">
	<link rel="icon" href="img/logo.png">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script type="text/javascript" src="dropdown1.js?v=2"></script>
<script type="text/javascript" src="sidebar.js"></script>
<script type="text/javascript" src="changefontsize.js?v=6"></script>
<script type="text/javascript" src="changecolor.js?v=8"></script>
<?php 

	require 'header2.php';

 ?>
 <div id="home"></div>
	<?php require 'homepagecontent.php'; ?>


 <script type="text/javascript" src="slideshow1.js"></script>

<?php 

	require 'footer2.php';

 ?>

