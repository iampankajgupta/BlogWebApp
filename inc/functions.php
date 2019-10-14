<?php
require '../db_config.php';
session_start();


// FUNCTION TO LOG INTO WEBAPP AND START THE SEESION TO REMEMBER USER ID OD USER.
global $conn;

function login($email, $password)
{
	$sql = "SELECT * FROM users WHERE email ='$email' AND password ='$password'";
	global $conn;
	$query = mysqli_query($conn, $sql);
	$data = mysqli_fetch_assoc($query);
	$row = mysqli_num_rows($query);

	// IF A USER EXISTS ,SET SESSION AND RETURN TRUE

	if ($row > 0) {
		$_SESSION['userid'] = $data['Id'];
		return $data['password'] == $password;
	}
	return false;
}



// THIS FUNCTION IS CALLED TO CHECK INPUT BOX OR BUTTON IS EMPTY OR SET OR NOT

function does_exists($parameter)
{
	return (isset($parameter) && !empty($parameter));
}

// THIS FUNCTION IS CALLED WHEN REGISETER BUTTON IS CLICKED.

function register($username, $email, $password, $confrimPassword)
{
	global $conn;
	if ($password == $confrimPassword) {
		$query = " SELECT email FROM users WHERE email = '$email' ";
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0) {
			echo '<script type="text/javascript">';
			echo 'alert("Email has Already taken");';
			echo 'window.location.href = "../register.html"';
			echo '</script>';
		} else {

			$reg = "INSERT INTO users (username, email , password) VALUES ('$username','$email','$password')";
			mysqli_query($conn, $reg);

			return mysqli_insert_id($conn);
		}
	} else {

		echo '<script type="text/javascript">';
		echo 'alert("Password and Confirm Passwords are not matching...");';
		echo 'window.location.href = "../register.html"';
		echo '</script>';
	}
}

// THIS FUNCTION IS CALLED WHEN SEARCH BUTTON IS CLICKED

function searchBarLogic($search)
{
	$query = " SELECT * FROM contents WHERE article LIKE '%$search%' ";
	global $conn;
	$result = mysqli_query($conn, $query);
	$queryResult = mysqli_num_rows($result);
	echo $queryResult . " result found";
	if ($queryResult > 0) {
		while ($row = mysqli_fetch_assoc($result)) {

			echo "
			<ul>
			<li>
			<h4>
			<a href = 'showClickedPage.php?article_id=" . $row['article_id'] . "' class = 'p-2 text-center'>" . $row['title'] . "</a>
			</h4>
			</li>
			</ul>";
		}
	}
}

// THIS FUNCTION IS CALLED WHEN POST BUTTON IS CLICKED TO SUBMIT THE ARTICLE

function postButtonfunction($title, $post_textArea_content, $user_id)
{
	global $conn;
	//  INSERTING THE CONTENTS OF TEXT AREA INTO THE DATABASE
	$query = "INSERT INTO contents (title,article,user_id) VALUES('$title','$post_textArea_content','$user_id')";
	mysqli_query($conn, $query);

	return mysqli_insert_id($conn);
}


function deleteFunction($article_id)
{
	global $conn;

	$delete_query = "DELETE FROM contents WHERE article_id = '$article_id'";
	mysqli_query($conn, $delete_query);
	$delete_cat_query = "DELETE FROM category_article WHERE article_id='$article_id'";
	mysqli_query($conn, $delete_cat_query);
}


function click_update_function($article_id, $title, $text_area_content)
{
	global $conn;
	$update_query = " UPDATE contents SET title = '$title', article= '$text_area_content' WHERE article_id='$article_id'";
	mysqli_query($conn, $update_query);

	$cat_query = "DELETE FROM category_article WHERE article_id = '$article_id'";
	mysqli_query($conn,$cat_query);

	$query = 'INSERT INTO category_article (category_id, article_id) values ';
		foreach ($_POST['categories'] as $index => $category) {
			if ($index != 0) {
				$query .= ',';
			}
			$query .= "($category, $article_id)";
		}
		mysqli_query($conn, $query);

}
