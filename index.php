<?php
	require_once 'db_connect.php';
	$result = pg_query($dbconn, "SELECT * FROM users");
	$birthdate = pg_query($dbconn, "SELECT TO_CHAR(birthdate, 'Month dd, yyyy') FROM users");
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Management</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
		.table-custom-settings{
			padding-left: 50px;
			padding-right: 50px;
		}
		.custom-center{
			text-align: center !important;
			vertical-align: middle !important;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="title align-content-center">List of Users
			<div class="float-right">
				<input type="button" data-toggle="modal" data-target="#userAddModal" class="btn btn-outline-primary" value="Add User">
			</div>
		</div>
		<div class="modal fade" id="userAddModal" tabindex="-1" role="dialog" aria-labelledby="userAddModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="userAddModalLabel">Add User Data</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="add_user.php" method="POST">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">First Name</span>
									</div>
									<input type="text" class="form-control" name="firstname" placeholder="John/Jane" required/>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Last Name</span>
									</div>
									<input type="text" class="form-control" name="lastname" placeholder="Doe" required/>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Middle Name</span>
									</div>
									<input type="text" class="form-control" name="middlename" placeholder="Louis" required/>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Gender</span>
									</div>
									<select class="custom-select" name="status" required>
										<option selected>Select...</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Birthdate</span>
									</div>
									<input type="date" class="form-control" name="birthdate" required>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Status</span>
									</div>
									<select name="status" class="custom-select" required>
										<option selected>Select...</option>
										<option value="Single">Single</option>
										<option value="Married">Married</option>
										<option value="Divorced">Divorced</option>
										<option value="Separated">Separated</option>
										<option value="Widowed">Widowed</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Email</span>
									</div>
									<input type="email" class="form-control" name="email" placeholder="name@example.com" required>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Contact No.</span>
									</div>
									<input type="tel" class="form-control" name="contactno" placeholder="09012345678" required>
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<input type="submit" href="add_user.php" class="btn btn-primary" value="Submit">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="table-responsive align-content-center table-custom-settings">
			<table class="table table-borderless table-md table-hover">
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
						<td class="custom-center"><?php echo $row["first_name"]; ?></td>
						<td class="custom-center"><?php echo $row["last_name"]; ?></td>
						<td class="custom-center"><?php echo $row["middle_name"]; ?></td>
						<td class="custom-center"><?php echo $row["gender"]; ?></td>
						<td class="custom-center"><?php echo $date["to_char"]; ?></td>
						<td class="custom-center"><?php echo $row["status"]; ?></td>
						<td class="custom-center"><?php echo $row["email"]; ?></td>
						<td class="custom-center"><?php echo $row["contact_no"]; ?></td>
						<td class="custom-center">
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