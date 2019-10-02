<?php
require './inc/functions.php';
session_start();

$uemail = $_POST['lemail'];
$upassword = $_POST['lpassword'];

if (does_exists($uemail) && does_exists($upassword)) {

	if (login($uemail, $upassword)) {
		header('location:home.php');
	} else {
		echo '<script type="text/javascript">';
		echo 'alert("Email Address and Password are not matching");';
		echo 'window.location.href = "register.html"';
		echo '</script>';
	}
} else {
	echo "Please fill all the fields";
	echo does_exists($uemail);
	echo does_exists($upassword);
}
?>