<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>My Page</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="userPage_stylesheet.css">
</head>

<body>
	<div class=".container ">
		<div class="jumbotron text-center bg-warning">
			<h2 class="font-weight-bold">My Articles</h2>
			<a href="index.php" class="float-left font-weight-bold">Create New Article</a>
			<a href="home.php" class="float-right mr-2 font-weight-bold">Go To Home</a>
		</div>
		<form action="#" method="POST">
			<button class="float-right mr-2" name='search_submit'>Search</button>
			<input type="text" name="text_box" placeholder="Search..." class="float-right mr-2">
		</form>
	</div>
	<div>
		<h1 class="ml-3 mb-4 ">BLOG TITLES</h1>
	</div>
	<?php
	include_once 'db_config.php';


	if (isset($_POST['search_submit'])) {
		$user_id = $_SESSION['userid'];
		$search = mysqli_real_escape_string($conn, $_POST['text_box']);
		if (!empty($search)) {
			$query = "SELECT * FROM contents WHERE user_id = '$user_id' AND title LIKE '%$search%'";
			$result = mysqli_query($conn, $query);
			$queryResult = mysqli_num_rows($result);
			if ($queryResult > 0) {
				echo "<h3 class = 'ml-3'>" . $queryResult . " results found " . "</h4>";
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<ul>
					<li>
					<h4>
					<a href = 'showClickedPage.php?article_id=" . $row['article_id'] . "' class = 'p-2 text-center'>" . $row['title'] . "</a>
					</h4>
					</li>
					</ul>";
				}
			} else {
				echo "<h3 class = 'ml-3'>" . "No results found " . "</h4>";
			}
		} else {
			echo '<script type="text/javascript">';
			echo 'alert("Please fill the textbox then press search button");';
			echo 'window.location.href = "usersPage.php"';
			echo '</script>';
		}
	} else {
		$user_id = $_SESSION['userid'];
		$query1 = "SELECT article_id, title FROM contents WHERE user_id = '$user_id'";
		$result1 = mysqli_query($conn, $query1);
		if (mysqli_num_rows($result1) > 0) {
			while ($row = mysqli_fetch_array($result1)) {
				echo "
			<ul>
			<li>
			<h4>
			<a href = 'showClickedPage.php?article_id=" . $row['article_id'] . "' class = 'p-2 text-center'>" . $row['title'] . "</a>
			</h4>
			</li>
			</ul>";
			}
		} else {
			echo "<h3><a href ='index.php' class ='ml-3 mt-2'>START CREATING YOUR ARTICLE</a></h3>";
		}
	}
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>

</html>