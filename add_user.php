<?php
	require_once 'db_connect.php';
	if(isset($_POST['submit'])){
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
		$middle_name = $_POST['middlename'];
		$gender = $_POST['gender'];
		$birthdate = $_POST['birthdate'];
		$status = $_POST['status'];
		$email = $_POST['email'];
		$contact_no = $_POST['contactno'];
		$sql = "INSERT INTO users (first_name,last_name,middle_name,gender,birthdate,status,email,contact_no) VALUES ('$first_name','$last_name','$middle_name','$gender', '$birthdate','$status','$email','$contact_no')";
	        if(pg_query($dbconn,$sql)){
        	        header("Location: index.php");
       		 }
	}
	pg_close($dbconn);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script scr="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid align-content-center">
		<div class="jumbotron">
			<h1>ADD USER FORM</h1>
			<h6>Please fill out all requirements</h6>
			<form action="add_user.php" method="POST">
				First Name: <input type="text" name="firstname" required/><br/>
				Last Name: <input type="text" name="lastname" required/><br/>
				Middle Name: <input type="text" name="middlename"required/><br/>
				Gender: <input type="radio" name="gender" value="Male" required>Male&nbsp;&nbsp;<input type="radio" name="gender" value="Female" required>Female<br/>

				Birthdate: <input type="date" name="birthdate" required><br/>
				Status: <select name="status" required>
					<option value="Single">Single</option>
					<option value="Married">Married</option>
					<option value="Divorced">Divorced</option>
					<option value="Separated">Separated</option>
					<option value="Widowed">Widowed</option>
				</select><br/>
				Email: <input type="email" name="email" required/><br/>
				Contact No: <input type="tel" name="contactno" required/><br/>
				<input type="submit" value="Submit" name="submit"/>
			</form>
		</div>
	</div>
</body>
</html>