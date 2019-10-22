<?php
require 'inc/functions.php';

$user_id =$_SESSION['userid'];
$article_id =$_POST['article_id'];
if (does_exists($_POST['user_comm'])) {
	$comment_content = $_POST['user_comm'];
	$insert_comment_query = "INSERT INTO comments(user_id,article_id,comment)VALUES('$user_id','$article_id','$comment_content')";
	mysqli_query($conn, $insert_comment_query);
	
	// get username

	$query1 = mysqli_fetch_assoc(mysqli_query($conn, "select username from users where id = $user_id"));

	echo "<div class='border border-warning mt-2 ml-2 text-capitalize '><h6 class='ml-3 mt-3 mr-3'>" .
	"By " .
	$query1['username'] . "<hr>" .
	$comment_content . "<br><br>" .
	date("Y-m-d h:i:s") .
	"</h6></div>";

}else{
	echo "<div class='mt-2 ml-2 text-capitalize'> Comment is Required.... </div>";
}
// $comment_query = "SELECT users.username,comments.comment,comments.created_at FROM users JOIN comments on users.Id = comments.user_id WHERE comments.article_id = '$article_id'";
// $result = mysqli_query($conn, $comment_query);
// while ($row = mysqli_fetch_array($result)) {

// 	echo "<div class='border border-warning mt-2 ml-2 text-capitalize '><h6 class='ml-3 mt-3 mr-3'>" .
// 		"By " .
// 		$row['username'] . "<hr>" .
// 		$row['comment'] . "<br><br>" .
// 		$row['created_at'] .
// 		"</h6></div>";
// }

?>
