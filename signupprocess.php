<?php 

	if(isset($_POST['signup-submit'])) {

		require 'dbconnect.php';
		session_start();
		$username = $_POST['uid'];
		$email = $_POST['mail'];
		$password = $_POST['pwd'];
		$passwordConfirmed = $_POST['pwd-confirm'];
		$realname = $_POST['name'];
		$identitycard = $_POST['noic'];
		$phonenumber = $_POST['notel'];

		if(empty($username) || empty($email) || empty($password) || empty($passwordConfirmed) || empty($realname) || empty($identitycard) || empty($phonenumber)) {
			$_SESSION['error'] = "emptyfields";
			$_SESSION['tmp_uid'] = $username;
			$_SESSION['tmp_mail'] = $email;
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_noic'] = $identitycard;
			$_SESSION['tmp_notel'] = $phonenumber;
			if(!empty($password) && !empty($passwordConfirmed)) {
				$_SESSION['tmp_pwd'] = true;
				header("Location: signup.php");
			} else {
				header("Location: signup.php");
			}
			
			exit();

		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			$_SESSION['error'] = "invalidmailuid";
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_noic'] = $identitycard;
			$_SESSION['tmp_notel'] = $phonenumber;
			header("Location: signup.php");
			exit();

		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION['error'] = "invalidmail";
			$_SESSION['tmp_uid'] = $username;
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_noic'] = $identitycard;
			$_SESSION['tmp_notel'] = $phonenumber;
			header("Location: signup.php");
			exit();

		} else if(!preg_match("/^[a-zA-Z0-9]*$/", $username) || (strlen($username) < 4) || (strlen($username) > 20)) {
			$_SESSION['error'] = "invaliduid";
			$_SESSION['tmp_mail'] = $email;
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_noic'] = $identitycard;
			$_SESSION['tmp_notel'] = $phonenumber;
			header("Location: signup.php");
			exit();

		} else if(!preg_match("/^[a-zA-Z0-9]*$/", $password) || (strlen($password) < 4) || (strlen($password) > 20)) {
			$_SESSION['error'] = "invalidpwd";
			$_SESSION['tmp_uid'] = $username;
			$_SESSION['tmp_mail'] = $email;
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_noic'] = $identitycard;
			$_SESSION['tmp_notel'] = $phonenumber;
			header("Location: signup.php");
			exit();

		} else if(!preg_match("/^[A-Za-z]++(?>[A-Za-z\s]+[A-Za-z]+)?+$/", $realname) || (strlen($realname) > 20)) {
			$_SESSION['error'] = "invalidname";
			$_SESSION['tmp_uid'] = $username;
			$_SESSION['tmp_mail'] = $email;
			$_SESSION['tmp_noic'] = $identitycard;
			$_SESSION['tmp_notel'] = $phonenumber;
			header("Location: signup.php");
			exit();

		} else if(!preg_match("/^[0-9]*$/", $identitycard) || (strlen($identitycard) < 12) || (strlen($identitycard) > 12)) {
			$_SESSION['error'] = "invalidnokp";
			$_SESSION['tmp_uid'] = $username;
			$_SESSION['tmp_mail'] = $email;
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_notel'] = $phonenumber;
			header("Location: signup.php");
			exit();

		} else if(!preg_match("/^01[0-9]*$/", $phonenumber) || (strlen($phonenumber) < 10) || (strlen($phonenumber) > 11)) {
			$_SESSION['error'] = "invalidtel";
			$_SESSION['tmp_uid'] = $username;
			$_SESSION['tmp_mail'] = $email;
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_noic'] = $identitycard;
			header("Location: signup.php");
			exit();

		} else if($password !== $passwordConfirmed) {
			$_SESSION['error'] = "passwordCheck";
			$_SESSION['tmp_uid'] = $username;
			$_SESSION['tmp_mail'] = $email;
			$_SESSION['tmp_name'] = $realname;
			$_SESSION['tmp_noic'] = $identitycard;
			$_SESSION['tmp_notel'] = $phonenumber;
			header("Location: signup.php");
			exit();

		} else {

			$sql = "SELECT Username, NoKP, Emel FROM pelanggan WHERE BINARY Username=? OR NoKP = ? OR Emel = ?";
			$stmt = mysqli_stmt_init($conn);

			if(!mysqli_stmt_prepare($stmt, $sql)) {
				$_SESSION['error'] = "sqlerror";
				header("Location: signup.php");

				exit();

			} else {

				mysqli_stmt_bind_param($stmt, "sss", $username, $identitycard, $email);
				mysqli_stmt_execute($stmt);
				
				$result = mysqli_stmt_get_result($stmt);
				$row = mysqli_fetch_assoc($result);
				$u = $row['Username'];
				$ic = $row['NoKP'];
				$e = $row['Emel'];

				if($u == $username) {
					$_SESSION['error'] = "usertaken";
					$_SESSION['tmp_mail'] = $email;
					$_SESSION['tmp_name'] = $realname;
					$_SESSION['tmp_noic'] = $identitycard;
					$_SESSION['tmp_notel'] = $phonenumber;
			        header("Location: signup.php");
					exit();

				} else if($e == $email) {
					$_SESSION['error'] = "emailtaken";
					$_SESSION['tmp_uid'] = $username;
					$_SESSION['tmp_name'] = $realname;
					$_SESSION['tmp_noic'] = $identitycard;
					$_SESSION['tmp_notel'] = $phonenumber;
			        header("Location: signup.php");
					exit();
				} else if($ic == $identitycard) {
					$_SESSION['error'] = "identitycardtaken";
					$_SESSION['tmp_uid'] = $username;
					$_SESSION['tmp_mail'] = $email;
					$_SESSION['tmp_name'] = $realname;
					$_SESSION['tmp_notel'] = $phonenumber;
			        header("Location: signup.php");
					exit();
				} else {
                    //Memasukkan Data Pelanggan Seperti Nama, NoKP Dan Sebagainya Ke Dalam Pangkalan Data
					$sql = "INSERT INTO pelanggan(Nama, NoKP, NoTel, Emel, Username, KataLaluan, ProfilePicture) VALUES(?, ?, ?, ?, ?, ?, 'profile.jpg')";
					$stmt = mysqli_stmt_init($conn);

					if(!mysqli_stmt_prepare($stmt, $sql)) {
						$_SESSION['error'] = "sqlerror";
						header("Location: signup.php");

						exit();

					} else {
						$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt, "ssssss", $realname, $identitycard, $phonenumber, $email, $username, $hashedPwd);
						mysqli_stmt_execute($stmt);
						setcookie("uid", $username, time() + 86400);
						$_SESSION['signup'] = "success";
						header("Location: login.php");
						exit();
					}

				}
			}

		} 

		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	} else {

		header("Location: login.php");

		exit();
	}


 ?>