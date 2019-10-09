<?php
session_start();
require 'db_config.php';
if (isset($_POST['comment_btn'])) {
	$comment = $_POST['comment'];
	$user_id = $_SESSION['userid'];
	$article_id = $_GET['article_id'];
	$comment_query = "INSERT INTO comments(user_id,article_id,comment)VALUES('$user_id','$article_id','$comment')";
	mysqli_query($conn, $comment_query);
}
?>

<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="showClickedPage.css">
</head>
<body>
<div class=".container">
<div class="jumbotron text-center bg-warning ">

<!-- PRINT THE TITLE OF THE ARTICLE TO THE TOP OF THE HEAD -->

<?php

$articleId = $_GET['article_id'];
$query = "SELECT title FROM contentS WHERE article_id = '$articleId'";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
	echo "<h2 class = 'text-capitalize'>" . $row['title'] . "</h2>";
}

?>

<a href="home.php" class=" float-left font-weight-bold">Go To Home</a>
<a href="usersPage.php" class="float-right font-weight-bold">My page</a>
</div>

<div class = "border-bottom mb-2">
<a href = "editPage.php?action=edit&article_id=<?php echo $_GET['article_id'] ?>"  class = "ml-3">Edit</a>
<a href = "inc/actions.php?action=delete&article_id=<?php echo $_GET['article_id'] ?>" onclick="return confirm('Do you really want to delete this  Article?');" class = "ml-3">Delete</a>
</div><br>

<!--  THIS CODE IS FOR DISPLAYING THE CONTENT OF THE ARTICLE  -->

<?php

$articleId = $_GET['article_id'];
$query = "SELECT * FROM contents WHERE article_id = '$articleId'";
$query = mysqli_query($conn, "SELECT * FROM contents WHERE article_id = $articleId");
while ($row = mysqli_fetch_assoc($query)) {
	echo "<div class ='ml-3 mb-5 mr-1'>" . $row['article'] . "</div>";
}

?>
</div>
<div class="ml-2 mr-4" id="comment_form" action="showClickedPage.php?article_id=<?echo $_GET['article_id']?>">
<form action="" method="POST">
    <div class="form-group">
        <label for="">Comments:</label>
    </div>
<div class="form-group">
<textarea name="comment_content" class="form-control" id="" cols="10" rows="5"></textarea>
</div>
<div class="form-group">
<input type="submit" name="submit" value="Comment" />
</div>
</form>
</div>

<?php

require 'db_config.php';
$user_id = $_SESSION['userid'];
$article_id = $_GET['article_id'];
if (isset($_POST['submit'])) {
	$comment_content = $_POST['comment_content'];
	$insert_comment_query = "INSERT INTO comments(user_id,article_id,comment)VALUES('$user_id','$article_id','$comment_content')";
	mysqli_query($conn, $insert_comment_query);
}
$comment_query = "SELECT users.username,comments.comment,comments.created_at FROM users JOIN comments on users.Id = comments.user_id where comments.article_id = '$article_id'";
$result = mysqli_query($conn, $comment_query);
while ($row = mysqli_fetch_array($result)) {

	echo "<div class='border border-warning mt-2 ml-2 text-capitalize '><h6 class='ml-3 mt-3 mr-3'>" .
	 "By ".
	  $row['username'] . "<hr>" .
	  $row['comment'] . "<br>" .
	  $row['created_at'] .
	"</h6></div>";
}
?>

</body>
</html>


