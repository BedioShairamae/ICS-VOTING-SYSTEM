<?php
	session_start();
	unset($_SESSION['admin_id_token']);
	unset($_SESSION['electsched']);
	header("location:index.php");

?>