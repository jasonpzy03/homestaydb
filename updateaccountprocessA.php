<?php 

	if(isset($_POST['update-acc-submit'])) {

		require 'dbconnect.php';
		session_start();
		$username = $_POST['uid'];
		$email = $_POST['mail'];
		$password = $_POST['pwd'];
		$passwordConfirmed = $_POST['pwd-confirm'];
		$realname = $_POST['name'];
		$phonenumber = $_POST['notel'];

		if(empty($username) || empty($email) || empty($password) || empty($passwordConfirmed) || empty($realname) || empty($phonenumber)) {
			$_SESSION['error'] = "emptyfields";
			$_SESSION['tmp_uid'] = $username;
			$_SESSION['tmp_mail'] = $email;
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_notel'] = $phonenumber;
			if(!empty($password) && !empty($passwordConfirmed)) {
				$_SESSION['tmp_pwd'] = true;
				header("Location: manageaccountA.php");
			} else {
				header("Location: manageaccountA.php");
			}
			
			exit();

		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			$_SESSION['error'] = "invalidmailuid";
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_notel'] = $phonenumber;
				header("Location: manageaccountA.php");
			exit();

		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION['error'] = "invalidmail";
			$_SESSION['tmp_uid'] = $username;
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_notel'] = $phonenumber;
				header("Location: manageaccountA.php");
			exit();

		} else if(!preg_match("/^[a-zA-Z0-9]*$/", $username) || (strlen($username) < 4) || (strlen($username) > 20)) {
			$_SESSION['error'] = "invaliduid";
			$_SESSION['tmp_mail'] = $email;
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_notel'] = $phonenumber;
				header("Location: manageaccountA.php");
			exit();

		} else if(!preg_match("/^[a-zA-Z0-9]*$/", $password) || (strlen($password) < 4) || (strlen($password) > 20)) {
			$_SESSION['error'] = "invalidpwd";
			$_SESSION['tmp_uid'] = $username;
			$_SESSION['tmp_mail'] = $email;
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_notel'] = $phonenumber;
				header("Location: manageaccountA.php");
			exit();

		} else if(!preg_match("/^[A-Za-z]++(?>[A-Za-z\s]+[A-Za-z]+)?+$/", $realname) || (strlen($realname) > 20)) {
			$_SESSION['error'] = "invalidname";
			$_SESSION['tmp_uid'] = $username;
			$_SESSION['tmp_mail'] = $email;
			$_SESSION['tmp_notel'] = $phonenumber;
				header("Location: manageaccountA.php");
			exit();

		} else if(!preg_match("/^01[0-9]*$/", $phonenumber) || (strlen($phonenumber) < 10) || (strlen($phonenumber) > 11)) {
			$_SESSION['error'] = "invalidtel";
			$_SESSION['tmp_uid'] = $username;
			$_SESSION['tmp_mail'] = $email;
			$_SESSION['tmp_name'] = $realname;
				header("Location: manageaccountA.php");
			exit();

		} else if($password !== $passwordConfirmed) {
			$_SESSION['error'] = "passwordCheck";
			$_SESSION['tmp_uid'] = $username;
			$_SESSION['tmp_mail'] = $email;
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_notel'] = $phonenumber;
				header("Location: manageaccountA.php");
			exit();

		} else {

			$sql = "SELECT Username, Emel FROM pelanggan WHERE Username=? OR Emel = ?";
			$stmt = mysqli_stmt_init($conn);

			if(!mysqli_stmt_prepare($stmt, $sql)) {
 				$_SESSION['error'] = "sqlerror";
				header("Location: manageaccountA.php");

				exit();

			} else {

				mysqli_stmt_bind_param($stmt, "ss", $username, $email);
				mysqli_stmt_execute($stmt);
				
				$result = mysqli_stmt_get_result($stmt);
				while($row = mysqli_fetch_assoc($result)) {
					$u = $row['Username'];
				$e = $row['Emel'];

				if($u == $username) {
					if($_SESSION['userUid'] !== $u) {
						$_SESSION['error'] = "usertaken";
					$_SESSION['tmp_mail'] = $email;
					$_SESSION['tmp_name'] = $realname;
					$_SESSION['tmp_notel'] = $phonenumber;
						header("Location: manageaccountA.php");

						exit();
					}
					

				} 
				if($e == $email) {
					if($_SESSION['mail'] !== $e) {
						$_SESSION['error'] = "emailtaken";
					$_SESSION['tmp_uid'] = $username;
					$_SESSION['tmp_name'] = $realname;
					$_SESSION['tmp_notel'] = $phonenumber;
						header("Location: manageaccountA.php");

						exit();
					} 
					
				} 
				}
				
				
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
					$sql2 = "UPDATE pelanggan SET Nama = ?, NoTel = ?, Emel = ?, Username = ?, KataLaluan = ? WHERE IDPelanggan = ?";
					$stmt2 = mysqli_stmt_init($conn);

					if(!mysqli_stmt_prepare($stmt2, $sql2)) {
 						$_SESSION['error'] = "sqlerror";

						header("Location: manageaccountA.php");

						exit();
 
					} else {
						mysqli_stmt_bind_param($stmt2, "sssssi", $realname, $phonenumber, $email, $username, $hashedPwd, $_SESSION['userId']);
						mysqli_stmt_execute($stmt2);
						
						$_SESSION['NoTel'] = $phonenumber;
						$_SESSION['name'] = $realname;
						$_SESSION['userUid'] = $username;
						$_SESSION['mail'] = $email;
						setcookie("uid", $_SESSION['userUid'], time() + 86400);
						if($_FILES["file"]["name"]) {
							$profile = time() . "_" . $_FILES["file"]["name"];
							$target = "img/profilepics/" . $profile;
							move_uploaded_file($_FILES["file"]["tmp_name"], $target);

							$sql5 = "UPDATE pelanggan SET ProfilePicture = ? WHERE IDPelanggan = ?";
							$stmt5 = mysqli_stmt_init($conn);

							if(!mysqli_stmt_prepare($stmt5, $sql5)) {

								$_SESSION['error'] = "sqlerror";
								header("Location: manageaccountA.php");

								exit();
		 
							} else {

								mysqli_stmt_bind_param($stmt5, "si", $profile, $_SESSION['userId']);
								mysqli_stmt_execute($stmt5);
								$_SESSION['pic'] = $profile;
								$_SESSION['update'] = "success";
								header("Location: manageaccountA.php");
							}
						} else {
							$_SESSION['update'] = "success";
							header("Location: manageaccountA.php");
							exit();
						}
					}

				
			}

		} 

		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	} else if(isset($_POST['removepic-submit'])) {
		require 'dbconnect.php';
		session_start();
		$sql5 = "UPDATE pelanggan SET ProfilePicture = ? WHERE IDPelanggan = ?";
		$stmt5 = mysqli_stmt_init($conn);
		$profile = "profile.jpg";
		if(!mysqli_stmt_prepare($stmt5, $sql5)) {

			$_SESSION['error'] = "sqlerror";
			header("Location: manageaccountA.php");

			exit();
		 
		} else {

			mysqli_stmt_bind_param($stmt5, "si", $profile, $_SESSION['userId']);
			mysqli_stmt_execute($stmt5);
			$_SESSION['pic'] = $profile;
			$_SESSION['update'] = "success";
			header("Location: manageaccountA.php");
			exit();
		}

	} else {

		header("Location: admin.php");

		exit();
	}
 ?>