<?php 

	if(isset($_POST['update-submit'])) {
		session_start();
		require 'dbconnect.php';

		$date = $_POST['date'];

		$amountofdays = $_POST['amountofdays'];
		$enddate = date('Y-m-d', strtotime($date. " + $amountofdays days"));
		$totalprice = $_POST['totalprice'];
		$homestayID = $_GET['homestayID'];
		$customerID = $_SESSION['userId'];
		$bookingID = $_GET['bookingID'];
		$sql3 = "SELECT HargaSehari FROM rumah WHERE IDRumah=?";
		$stmt5 = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt5, $sql3)) {
			$_SESSION['error'] = 'sqlerror';
			header("Location: customermanaging.php?homestayID=".$homestayID."&bookingID=".$bookingID);
			exit();
		} else {
			mysqli_stmt_bind_param($stmt5, "i", $homestayID);
			mysqli_stmt_execute($stmt5);
			$result = mysqli_stmt_get_result($stmt5);
			$row = mysqli_fetch_assoc($result);

			$total = $row['HargaSehari'] * $amountofdays;
			if(empty($date) || empty($amountofdays)) {
				$_SESSION['error'] = 'emptyfields';
			header("Location: customermanaging.php?homestayID=".$homestayID."&bookingID=".$bookingID);
			exit();
		} else if((strlen($amountofdays) > 3) ||  !(is_numeric($amountofdays))) {
			$_SESSION['error'] = 'invaliddays';
			header("Location: customermanaging.php?homestayID=".$homestayID."&bookingID=".$bookingID);
			exit();

		} else if($total != $totalprice) {
			$_SESSION['error'] = 'calculationerror';
			header("Location: customermanaging.php?homestayID=".$homestayID."&bookingID=".$bookingID);
			exit();
		} else {
			$sql = "UPDATE sewaan SET TarikhSewaan = ?, TarikhAkhir = ?, TempohSewaan = ?, JumlahHarga = ? WHERE IDSewaan = ?";
			
			$stmt = mysqli_stmt_init($conn);
			
			if(!mysqli_stmt_prepare($stmt, $sql)) {
				$_SESSION['error'] = 'sqlerror';
				header("Location: customermanaging.php?homestayID=".$homestayID."&bookingID=".$bookingID);

				exit();
			} else {

				mysqli_stmt_bind_param($stmt, "ssidi", $date, $enddate, $amountofdays, $totalprice, $bookingID);
				mysqli_stmt_bind_param($stmt2, "ssidi", $date, $enddate, $amountofdays, $totalprice, $bookingID);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_execute($stmt2);
				$_SESSION['update'] = 'success';
				header("Location: receipt.php?homestayID=".$_GET['homestayID']);
				exit();
			}
			
		}
		}

		
	}else if(isset($_POST['remove-submit'])) {
		require 'dbconnect.php';
		session_start();
		$bookingID = $_GET['bookingID'];
		$homestayID = $_GET['homestayID'];
		$sql = "DELETE FROM sewaan WHERE IDSewaan = ?";
		$sql2 = "UPDATE rumah SET Booked='0' WHERE IDRumah=?";
		$stmt = mysqli_stmt_init($conn);
		$stmt2 = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			$_SESSION['error'] = 'sqlerror';
				header("Location: customermanaging.php?homestayID=".$homestayID."&bookingID=".$bookingID);

				exit();
		} else if(!mysqli_stmt_prepare($stmt2, $sql2)) {
			$_SESSION['error'] = 'sqlerror';
			header("Location: customermanaging.php?homestayID=".$homestayID."&bookingID=".$bookingID);

				exit();

		} else {

				mysqli_stmt_bind_param($stmt, "i", $bookingID);
				mysqli_stmt_execute($stmt);

				mysqli_stmt_bind_param($stmt2, "i", $homestayID);
				mysqli_stmt_execute($stmt2);

				$_SESSION['remove'] = "success";

				header("Location: managebooking.php");
				exit();
			}

	} else if(isset($_POST['view-receipt-submit'])) {
		header("Location: receipt.php?homestayID=".$_GET['homestayID']);
		exit();
	} else {
		header("Location: customer.php");
		exit();
	}
 ?>