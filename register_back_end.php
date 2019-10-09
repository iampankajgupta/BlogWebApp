<?php
session_start();
require 'db_config.php';

$typed_username = $_POST['rusername'];
$typed_email = $_POST['remail'];
$typed_password = $_POST['rpassword'];
$typed_confirm_password = $_POST['rconfirmPassword'];

if (empty($typed_username) || empty($typed_email) || empty($typed_password)) {
	if ($typed_password == $typed_confirm_password) {

		$query = "SELECT * FROM users WHERE email = '$typed_email'";
		$result = mysqli_query($conn, $query);
		$row_count = mysqli_num_rows($result);
		if ($row_count > 0) {
			echo '<script type="text/javascript">';
			echo 'alert("Email has Already taken");';
			echo 'window.location.href = "register.html"';
			echo '</script>';
		} else {
			$hash_password = hash('sha512',$typed_password);
			$reg = "INSERT INTO users(username,email,password) VALUES('$typed_username','$typed_email','$hash_password')";
			mysqli_query($conn, $reg);
			header('location:home.php');
		}
	} else {
		echo '<script type="text/javascript">';
		echo 'alert("Password are not matching...");';
		echo 'window.location.href = "register.html"';
		echo '</script>';
	}
}
