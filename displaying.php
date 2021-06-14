<?php 

	include("mysession.php");
	include("checkidforadmin.php");
	require 'dbconnect.php';
	if(!isset($_GET['homestayid'])) {
		header("Location: display.php");
		exit();
	}
	$sql5 = "SELECT * FROM rumah WHERE IDRumah=?";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql5)) {
		header("Location: display.php?error=sqlerror");
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "i", $_GET['homestayid']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if(mysqli_num_rows($result) <= 0) {
			header("Location: display.php");
			exit();
		}
	}
	
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Display | Homestay Rumah JOHO</title>
	<link rel="stylesheet" type="text/css" href="prerequisite.css?v=4">
	<link rel="stylesheet" type="text/css" href="headerbar2.css?v=3">
	<link rel="stylesheet" type="text/css" href="displaying1.css?v=3">
	<link rel="icon" href="img/logo.png">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<?php 

	require 'adminheader2.php';

 ?>

	<div class="title">
		<h1>Displaying</h1>

		<div class="title2">
			<p>HomestayID: </p>
			<?php 

			$sql = "SELECT IDRumah FROM rumah";
			$result = mysqli_query($conn, $sql);
			$i = 1;
			while($row = mysqli_fetch_array($result)) {
				$IDRumah[$i] = $row['IDRumah'];
				$i++;
			}
			echo "<select onchange='location = this.value;'>";
			for($n = 1; $n < $i; $n++) {
				if($_GET['homestayid'] == $IDRumah[$n]) {
					echo "<option selected = 'selected' value='displaying.php?display=success&homestayid=".$IDRumah[$n]."'>".$IDRumah[$n]."</option>";
				} else {
					echo "<option value='displaying.php?display=success&homestayid=".$IDRumah[$n]."'>".$IDRumah[$n]."</option>";
				}
				
				
			}	
			echo "</select>";
			 ?>
			
			
		</div>
	</div>

	<div class="content">
		<table>
			<tr>
				<th>Booking ID</th>
				<th>Username</th>
				<th>Nama</th>
				<th>Emel</th>
				<th>NoKP</th>
				<th>NoTel</th>
				<th>TarikhSewaan</th>
				<th>TempohSewaan</th>
				<th>JumlahHarga</th>
			</tr>
				<?php 

					$sql2 = "SELECT IDSewaan, pelanggan.IDPelanggan, Nama, Username, NoKP, NoTel, Emel, sewaan.IDPelanggan, TarikhSewaan, TempohSewaan, JumlahHarga FROM sewaan, pelanggan WHERE IDRumah=? AND pelanggan.IDPelanggan = sewaan.IDPelanggan";
					$stmt2 = mysqli_stmt_init($conn);

					if(!mysqli_stmt_prepare($stmt2, $sql2)) {
						$_SESSION['error'] = "sqlerror";
						header("Location: display.php?error=sqlerror");
						exit();
					} else {
						mysqli_stmt_bind_param($stmt2, "i", $_GET['homestayid']);
						mysqli_stmt_execute($stmt2);
						$result2 = mysqli_stmt_get_result($stmt2);
						while($row = mysqli_fetch_assoc($result2)) {
							echo "<tr><td>".$row['IDSewaan']."</td><td>".$row['Username']."</td><td>".$row['Nama']."</td><td>".$row['Emel']."</td><td>".$row['NoKP']."</td><td>".$row['NoTel']."</td><td>".$row['TarikhSewaan']."</td><td>".$row['TempohSewaan']."</td><td>RM ".$row['JumlahHarga']."</td></tr>";
						}

					}

					

				 ?>
			
		</table>
	</div>
	
</body>
</html>