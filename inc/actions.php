<?php
require 'functions.php';

if (does_exists($_GET['action'])) {
	// mapping of functions vs action
	$action_function_mapping = array('register' => 'register_user', 'login' => 'login_user', 'edit' => 'editContentPage', 'delete' => 'deleteArticle', 'search_btn' => 'search_button_clicked', 'update' => 'updateFunction','pst_btn' => 'post_button_clicked', 'comment' => 'commentClicked');
	$action_function_mapping[$_GET['action']]();
	
}
// THIS FUNCTION IS CALLED WHEN REGISTER IS CALLED.

function register_user() {
	$typed_username = $_POST['rusername'];
	$typed_email = $_POST['remail'];
	$typed_password = $_POST['rpassword'];
	$typed_confirm_password = $_POST['rconfirmPassword'];
	if (does_exists($typed_username) || does_exists($typed_email) || does_exists($typed_password) || does_exists($typed_confirm_password)) {
		
		if (register($typed_username, $typed_email, $typed_password, $typed_confirm_password)) {
			header('location:home.php');
		} else {
			echo '<script type="text/javascript">';
			echo 'alert("Password and Confirm Passwords are not matching...");';
			echo 'window.location.href = "../register.html"';
			echo '</script>';
		}
	}
}

//  IF THE USER LOGGED IN THIS FUNCTION IS CALLED

function login_user() {
	$uemail = $_POST['lemail'];
	$upassword = $_POST['lpassword'];
	
	if (does_exists($uemail) && does_exists($upassword)) {
		
		if (login($uemail, $upassword)) {
			header('location:../home.php');
		} else {
			echo '<script type="text/javascript">';
			echo 'alert("Email Address and Password are not matching");';
			echo 'window.location.href = "../register.html"';
			echo '</script>';
		}
	} else {
		echo "Please fill all the fields";
	}
}

// ON CLICK POST THIS FUNCTION IS CALLED.

function post_button_clicked() {
	global $conn;
	$post_title = mysqli_real_escape_string($conn, $_POST['title']);
	$category = mysqli_real_escape_string($conn, $_POST['category']);
	$post_textArea_content = mysqli_real_escape_string($conn, $_POST['editor']);
	$user_id = $_SESSION['userid'];
	// $article_id = $_SESSION['article_id'];
	if (does_exists($post_textArea_content)) {
		postButtonfunction($post_title, $category, $post_textArea_content, $user_id);
		header('location:../usersPage.php');
	} else {
		echo "Please fill all the fields";
	}
}

function deleteArticle() {
	$article_id = $_GET['article_id'];
	deleteFunction($article_id);
	header('location:../home.php');
}
function editContentPage() {
	$article_id = $_GET['article_id'];
	editFunction($article_id);
	// header('location:../index.html');
}

// function commentClicked() {
	// 	$comment = $_POST['comment'];
	// 	$article_id = $_GET['article_id'];
	// 	commentFunction($article_id, $comment);
	
	// }
	function updateFunction(){
		$user_id = $_SESSION['userid'];
		$edit_query = "SELECT artcile_id FROM contents WHERE user_id = '$user_id'";
		$result = mysqli_query($conn,$edit_query);
		if($result){
			$article_id = $_GET['article_id'];
			$title = mysqli_real_escape_string($conn,$_POST['updateTitle']);
			$text_area_content = mysqli_real_escape_string($conn,$_POST['updateEditor_text']);
			click_update_function($article_id,$title,$text_area_content);
			header('location:../usersPage.php');
		}
		else{
			echo '<script type="text/javascript">';
			echo 'alert("You have not Authority to Edit this Article");';
			echo 'window.location.href = "../home.php"';
			echo '</script>';

		}
	}
	
	?>