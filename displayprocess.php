<?php 

	if(isset($_POST['display-submit'])) {
		session_start();
		$homestayID = $_POST['homestayID'];

		if(empty($homestayID) || $homestayID == 0) {
			$_SESSION['error'] = "emptyfields";
			header("Location: display.php");
			exit();
		} else {
			header("Location: displaying.php?display=success&homestayid=".$homestayID);
			exit();
		}
	} else {
		header('Location: admin.php');
		exit();
	}

 ?>