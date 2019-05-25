<?php
	require_once 'db_connect.php';
	$user_id = $_GET['id'];
	if(pg_query($dbconn,"DELETE FROM users WHERE user_id=$user_id")){
		header("Location: index.php");
	}
?>