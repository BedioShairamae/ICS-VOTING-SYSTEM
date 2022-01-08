<?php 
session_start();

unset($_SESSION['adviser_login']);
unset($_SESSION['scopesection']);
unset($_SESSION['scopecourse']);
unset($_SESSION['changepassword']);
header('location:../');
 ?>