<?php
	session_start();
	unset($_SESSION['election_id']);
	unset($_SESSION['voter_login']);
	unset($_SESSION['otpgood']);
	unset($_SESSION['useremail']);
	header("location:index.php");
?>