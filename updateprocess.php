<?php 

	if(isset($_POST['updatehomestay-submit'])) {

		require 'dbconnect.php';
		session_start();
		$homestayName = $_POST['homestayname'];
		$address = $_POST['address'];
		$priceperday = $_POST['price'];
		$homestayID = $_GET['homestayID'];
		$imageName = $_POST['imagename'];
		$description = $_POST['description'];

		if(empty($homestayName) || empty($address) || empty($priceperday) || empty($imageName) || empty($description)) {
			$_SESSION['error'] = "emptyfields";
			$_SESSION['address'] = $address;
			$_SESSION['priceperday'] = $priceperday;
			$_SESSION['imagename'] = $imageName;
			$_SESSION['description'] = $description;
			$_SESSION['homestayName'] = $homestayName;
			header("Location: updating.php?&homestayID=".$homestayID);
			exit();
		} else if(!preg_match("/^[0-9A-Za-z]++(?>[0-9A-Za-z\s]+[0-9A-Za-z]+)?+$/", $homestayName) || (strlen($homestayName) > 50)) {
			$_SESSION['error'] = "invalidname";
			$_SESSION['address'] = $address;
			$_SESSION['priceperday'] = $priceperday;
			$_SESSION['imagename'] = $imageName;
			$_SESSION['description'] = $description;
			header("Location: updating.php?&homestayID=".$homestayID);
			exit();

		} else if(!preg_match("/^[0-9A-Za-z,.\/]++(?>[0-9A-Za-z,.\/\s]+[0-9A-Za-z,.\/]+)?+$/", $address) || (strlen($address) > 100)) {
			$_SESSION['error'] = "invalidaddress";
			$_SESSION['priceperday'] = $priceperday;
			$_SESSION['imagename'] = $imageName;
			$_SESSION['description'] = $description;
			$_SESSION['homestayName'] = $homestayName;
			header("Location: updating.php?&homestayID=".$homestayID);
			exit();

		} else if(!(is_numeric($priceperday)) || (strlen($priceperday) > 10)) {
			$_SESSION['error'] = "invalidharga";
			$_SESSION['address'] = $address;
			$_SESSION['imagename'] = $imageName;
			$_SESSION['description'] = $description;
			$_SESSION['homestayName'] = $homestayName;
			header("Location: updating.php?&homestayID=".$homestayID);
			exit();

		} else if(!preg_match("/^[a-zA-Z0-9.]*$/", $imageName) || (strlen($imageName) > 20)) {
			$_SESSION['error'] = "invalidimgname";
			$_SESSION['address'] = $address;
			$_SESSION['priceperday'] = $priceperday;
			$_SESSION['description'] = $description;
			$_SESSION['homestayName'] = $homestayName;
			header("Location: updating.php?&homestayID=".$homestayID);
			exit();

		} else if(!preg_match("/^[0-9A-Za-z,.\/]++(?>[0-9A-Za-z,.\/\s]+[0-9A-Za-z,.\/]+)?+$/", $description) || (strlen($description) > 100)) {
			$_SESSION['error'] = "invaliddesc";
			$_SESSION['address'] = $address;
			$_SESSION['priceperday'] = $priceperday;
			$_SESSION['imagename'] = $imageName;
			$_SESSION['homestayName'] = $homestayName;
			header("Location: updating.php?&homestayID=".$homestayID);
			exit();

		} else {

			$sql5 = "SELECT NamaRumah, IDRumah FROM rumah WHERE NamaRumah=?";
			$stmt5 = mysqli_stmt_init($conn);

			if(!mysqli_stmt_prepare($stmt5, $sql5)) {
				$_SESSION['error'] = "sqlerror";
			header("Location: updating.php?&homestayID=".$homestayID);
				exit();

			} else {

				mysqli_stmt_bind_param($stmt5, "s", $homestayName);
				mysqli_stmt_execute($stmt5);
				$result5 = mysqli_stmt_get_result($stmt5);
				while($row = mysqli_fetch_assoc($result5)) {
					$u = $row['NamaRumah'];
					$id = $row['IDRumah'];


				if($u == $homestayName) {
					if($homestayID != $id) {
						$_SESSION['error'] = "nametaken";
						$_SESSION['address'] = $address;
						$_SESSION['priceperday'] = $priceperday;
						$_SESSION['imagename'] = $imageName;
						$_SESSION['description'] = $description;
						header("Location: updating.php?homestayID=".$homestayID);
						exit();
					}
					

				} 
				}
                    //Mengemaskini Data Dalam Jadual rumah Dengan Data Yang Dimassukan Oleh Pengguna
					$sql = "UPDATE rumah SET NamaRumah = ?, Alamat = ?, HargaSehari = ?, ImageName = ?, Description = ? WHERE IDRumah = ?";
					mysqli_query($conn, $sql);
					$stmt = mysqli_stmt_init($conn);

					if(!mysqli_stmt_prepare($stmt, $sql)) {
						$_SESSION['error'] = "sqlerror";
			            header("Location: updating.php?homestayID=".$homestayID);	
                        exit();
					} else {
						mysqli_stmt_bind_param($stmt, "ssssss", $homestayName, $address, $priceperday, $imageName, $description, $homestayID);
						mysqli_stmt_execute($stmt);
						$_SESSION['update'] = "success";
			            header("Location: updating.php?homestayID=".$homestayID);			
                        exit();
					}
				}
				
			
		
	}
	} else if(isset($_POST['removehomestay-submit'])) {
		require 'dbconnect.php';
		$homestayID = $_GET['homestayID'];
		$sql3 = "DELETE FROM sewaan WHERE IDRumah = ?";
		$sql = "DELETE FROM rumah WHERE IDRumah = ?";

		$stmt = mysqli_stmt_init($conn);
		$stmt3 = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			$_SESSION['error'] = "sqlerror";
			header("Location: updating.php?homestayID=".$homestayID);
				exit();
		} else if(!mysqli_stmt_prepare($stmt3, $sql3)) {
			$_SESSION['error'] = "sqlerror";
			header("Location: updating.php?homestayID=".$homestayID);
				exit();

		} else {

				mysqli_stmt_bind_param($stmt, "i", $homestayID);
				mysqli_stmt_execute($stmt);

				mysqli_stmt_bind_param($stmt3, "i", $homestayID);
				mysqli_stmt_execute($stmt3);
				$_SESSION['remove'] = "success";
			header("Location: updating.php?homestayID=".$homestayID);			
				exit();
			}

		
	} else {
		header("Location: admin.php");
		exit();
	}
 ?>