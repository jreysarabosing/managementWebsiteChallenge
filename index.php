<?php
	require_once 'db_connect.php';
	$result = pg_query($dbconn, "SELECT * FROM users");
	$birthdate = pg_query($dbconn, "SELECT TO_CHAR(birthdate, 'Month dd, yyyy') FROM users");
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Management</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script scr="js/bootstrap.min.js"></script>
	<style>
		html,body{
			font-family: HP Simplified;
		}
		.title{
			font-size:36px;
			padding: 15px;
			text-align: center;
			margin: auto;
		}
		.table td{
			vertical-align: middle;
		}
		.custom-center{
			text-align: center;
			vertical-align: middle;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="title align-content-center">List of Users
			<div class="float-right">
				<a role="button" href="add_user.php" data-toggle="modal" class="btn btn-outline-primary">Add User</a>
			</div>
		</div>
		<div class="table-responsive align-content-center">
			<table class="table-hover table offset-md-1 col-md-10">
				<thead>
					<tr>
						<th class="custom-center">First Name</th>
						<th class="custom-center">Last Name</th>
						<th class="custom-center">Middle Name</th>
						<th class="custom-center">Gender</th>
						<th class="custom-center">Birthdate</th>
						<th class="custom-center">Status</th>
						<th class="custom-center">Email</th>
						<th class="custom-center">Contact No.</th>
						<th class="custom-center"></th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = pg_fetch_array($result)){
					$date = pg_fetch_array($birthdate) ?>
					<tr>
						<td><?php echo $row["first_name"]; ?></td>
						<td><?php echo $row["last_name"]; ?></td>
						<td><?php echo $row["middle_name"]; ?></td>
						<td><?php echo $row["gender"]; ?></td>
						<td><?php echo $date["to_char"]; ?></td>
						<td><?php echo $row["status"]; ?></td>
						<td><?php echo $row["email"]; ?></td>
						<td><?php echo $row["contact_no"]; ?></td>
						<td>
							<div class="btn-group-sm btn-group">
								<a role="button" href="update_user.php?id=<?php echo $row["user_id"]; ?>" class="btn btn-outline-warning">Update</a>
								<a role="button" href="delete_user.php?id=<?php echo $row["user_id"]; ?>" class="btn btn-outline-danger">Delete</a>
							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>	