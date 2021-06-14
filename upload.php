<?php 

	if(isset($_POST['import-submit'])) {
		if($_FILES['product_file']['name']) {

			$filename = explode(".", $_FILES['product_file']['name']);

			if(end($filename) == "csv") {

				$handle = fopen($_FILES['product_file']['tmp_name'], "r");

				while($data = fgetcsv($handle)) {

					

				}

			} else {
				echo '<script language="javascript">';
				echo 'alert("Please select a .CSV file!")';
				echo '</script>';
			}

		} else {
			echo '<script language="javascript">';
			echo 'alert("Please select a file!")';
			echo '</script>';
		}
	}

 ?>
