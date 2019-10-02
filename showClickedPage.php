<?php
session_start();
require 'db_config.php';
?>

<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<link rel="stylesheet" type="text/css" href="showClickedPage.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class=".container">
<div class="jumbotron text-center bg-warning ">

<!-- PRINT THE TITLE OF THE ARTICLE TO THE TOP OF THE HEAD -->

<?php 

$articleId = $_GET['article_id'];
$query = "SELECT title FROM contentS WHERE article_id = '$articleId'";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result)){
    echo "<h2>".$row['title']."</h2>";
}

?>

<a href="home.php" class=" float-left font-weight-bold">Go To Home</a>
<a href="usersPage.php" class="float-right font-weight-bold">My page</a>
</div>

<!-- <div class = "border-bottom mb-2">
<a href = "inc/actions?action=edit"  class = "ml-3">Edit</a>
<a href = "inc/actions.php?action=delete" class = "ml-3">Delete</a>
</div><br> -->

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
<div class="ml-1 p-2">
<form action="comments.php" method="POST">
<h6 class = "font-weight-bold">Comments:</h6>
<textarea name="comments" id="" cols="100" rows="8"></textarea><br>
<button type = "submit"  name = "comment_btn" value = "POST!"class="mt-2 p-2">Comment</button>
</form>
</div>
</body>
</html>


