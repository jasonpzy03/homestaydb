<?php 

	if(isset($_POST['book-submit'])) {
		
		session_start();
		require 'dbconnect.php';

		//Menerima input pelanggan
		$date = $_POST['date'];
		$amountofdays = $_POST['amountofdays'];
		$totalprice = $_POST['totalprice'];
		$homestayID = $_GET['homestayID'];
		$customerID = $_SESSION['userId'];
		$enddate = date('Y-m-d', strtotime($date. " + $amountofdays days"));
		$sql3 = "SELECT Booked, HargaSehari FROM rumah WHERE IDRumah=?";
		$stmt5 = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt5, $sql3)) {

			$_SESSION['error'] = 'sqlerror';
			header("Location: booknow.php");
			exit();

		} else {

			mysqli_stmt_bind_param($stmt5, "i", $homestayID);
			mysqli_stmt_execute($stmt5);
			$result = mysqli_stmt_get_result($stmt5);
			$row = mysqli_fetch_assoc($result);
			$total = $row['HargaSehari'] * $amountofdays;

			if(empty($date) || empty($amountofdays)) {

				$_SESSION['error'] = 'emptyfields';
				header("Location: booking.php?homestayID=".$homestayID);
				exit();

			} else if((strlen($amountofdays) > 3) || !preg_match("/^[0-9]*$/", $amountofdays)) {

				$_SESSION['error'] = 'invaliddays';
				header("Location: booking.php?homestayID=".$homestayID);
				exit();

			} else if($row['Booked'] != '0') {

				$_SESSION['error'] = 'bookedhomestay';
				header("Location: booknow.php");
				exit();

			} else if($total != $totalprice) {

				$_SESSION['error'] = 'calculationerror';
				header("Location: booking.php?homestayID=".$homestayID);
				exit();

			} else {

            	//Memasukkan Data Dimassukan Oleh Pengguna Ke Dalam Jadual sewaan
				$sql = "INSERT INTO sewaan(IDPelanggan, IDRumah, TarikhSewaan, TarikhAkhir, TempohSewaan, JumlahHarga) VALUES (?, ?, ?, ?, ?, ?)";
				$sql2 = "UPDATE rumah SET Booked='1' WHERE IDRumah=?";
				$stmt = mysqli_stmt_init($conn);
				$stmt2 = mysqli_stmt_init($conn);
				
				if(!mysqli_stmt_prepare($stmt, $sql)) {

					$_SESSION['error'] = 'sqlerror';
					header("Location: booking.php");
					exit();

				} else if(!mysqli_stmt_prepare($stmt2, $sql2)) {

					$_SESSION['error'] = 'sqlerror';
					header("Location: booking.php");
					exit();

				} else {

					mysqli_stmt_bind_param($stmt, "iissid", $customerID, $homestayID, $date, $enddate, $amountofdays, $totalprice);
					mysqli_stmt_execute($stmt);

					mysqli_stmt_bind_param($stmt3, "iissid", $customerID, $homestayID, $date, $enddate, $amountofdays, $totalprice);
					mysqli_stmt_execute($stmt3);

					mysqli_stmt_bind_param($stmt2, "i", $homestayID);
					mysqli_stmt_execute($stmt2);
					$_SESSION['book'] = 'success';
					header("Location: receipt.php?homestayID=".$homestayID."");
					exit();

				}

			}

		}	

	} else {

		header("Location: customer.php");
		exit();

	}

 ?>