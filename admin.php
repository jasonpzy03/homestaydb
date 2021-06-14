<?php 

	include("mysession.php");
	include("checkidforadmin.php");
	require 'adminheader.php';
 ?>

	<h1 class="title">Admin Privileges</h1>

	<div class="content">
		

		<section>
			<h2>Register</h2>

			<a class="btn2 b" href="register.php">Start</a>
		</section>
		
		<section class="middle">
			<h2>Import Data</h2>

			<a class="btn2 b" href="import.php">Start</a>
		</section>
		
		<section class="middle2">
			<h2>Display</h2>

			<a class="btn2 b" href="display.php">Start</a>
		</section>
		
		<section>
			<h2>Update</h2>

			<a class="btn2 b" href="updatehomestay.php">Start</a>
		</section>
	</div>


</body>
</html>