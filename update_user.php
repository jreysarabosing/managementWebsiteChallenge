<?php
	require_once 'db_connect.php';
	$user_id = $_GET['id'];
	$result = pg_query($dbconn, "SELECT * FROM users WHERE user_id=$user_id");
	if(isset($_POST['submit'])){
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
		$middle_name = $_POST['middlename'];
		$gender = $_POST['gender'];
		$birthdate = $_POST['birthdate'];
		$status = $_POST['status'];
		$email = $_POST['email'];
		$contact_no = $_POST['contactno'];
		$sql = "UPDATE users SET first_name='$first_name',last_name='$last_name',middle_name='$middle_name',gender='$gender',birthdate='$birthdate',status='$status',email='$email',contact_no='$contact_no' WHERE user_id='$user_id'";
	    if(pg_query($dbconn,$sql)){
  	        header("Location: index.php"); 
       	}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update User</title>
</head>
<body>
	<h1>UPDATE USER FORM</h1>
	<h6>Please edit relevant data.</h6>
	<?php $row = pg_fetch_array($result) ?>
	<form action="update_user.php?id=<?php echo $user_id; ?>" method="POST">
		First Name: <input type="text" name="firstname" value="<?php echo $row["first_name"]; ?>" required/><br/>
		Last Name: <input type="text" name="lastname" value="<?php echo $row["last_name"]; ?>" required/><br/>
		Middle Name: <input type="text" name="middlename" value="<?php echo $row["middle_name"]; ?>" required/><br/>
		Gender: 
		<?php
			$gen = $row["gender"];
			if($gen == "Male"){ ?>
				<input type="radio" name="gender" value="Male" checked required>Male&nbsp;&nbsp;<input type="radio" name="gender" value="Female" required>Female<br/>
		<?php } else if($gen == "Female"){ ?>
				<input type="radio" name="gender" value="Male" required>Male&nbsp;&nbsp;<input type="radio" name="gender" value="Female" checked required>Female<br/>
		<?php } ?>
		Birthdate: <input type="date" name="birthdate" value="<?php echo $row["birthdate"]; ?>" required><br/>
		Status: 
		<?php
			$stat = $row["status"];
			if($stat == "Single"){
		?>
		<select name="status" required>
			<option value="Single" selected>Single</option>
			<option value="Married">Married</option>
			<option value="Divorced">Divorced</option>
			<option value="Separated">Separated</option>
			<option value="Widowed">Widowed</option>
		</select><br/>
		<?php } else if($stat == "Married"){ ?>
		<select name="status" required>
			<option value="Single">Single</option>
			<option value="Married" selected>Married</option>
			<option value="Divorced">Divorced</option>
			<option value="Separated">Separated</option>
			<option value="Widowed">Widowed</option>
		</select><br/>
		<?php } else if($stat == "Divorced"){ ?>
		<select name="status" required>
			<option value="Single">Single</option>
			<option value="Married">Married</option>
			<option value="Divorced" selected>Divorced</option>
			<option value="Separated">Separated</option>
			<option value="Widowed">Widowed</option>
		</select><br/>
		<?php } else if($stat == "Separated"){ ?>
		<select name="status" required>
			<option value="Single">Single</option>
			<option value="Married">Married</option>
			<option value="Divorced">Divorced</option>
			<option value="Separated" selected>Separated</option>
			<option value="Widowed">Widowed</option>
		</select><br/>
		<?php } else if($stat == "Widowed"){ ?>
		<select name="status" required>
			<option value="Single">Single</option>
			<option value="Married">Married</option>
			<option value="Divorced">Divorced</option>
			<option value="Separated">Separated</option>
			<option value="Widowed" selected>Widowed</option>
		</select><br/>
		<?php } ?>
		Email: <input type="email" name="email" value="<?php echo $row["email"]; ?>" required/><br/>
		Contact No: <input type="tel" name="contactno" value="<?php echo $row["contact_no"]; ?>" required/><br/>
		<input type="submit" value="Submit" name="submit"/>
	</form>
</body>
</html>