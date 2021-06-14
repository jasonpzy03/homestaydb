<?php 

	if(isset($_SESSION['id'])) {
		if($_SESSION['NoIC'] != "030610012111") {

		header("Location: customer.php");
		exit();
		}
		
	}

 ?>