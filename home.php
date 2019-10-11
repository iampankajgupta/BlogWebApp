<?php
session_start();

if (!@$_SESSION['userid']) {
  $_SESSION['userid'] = null;
  header('location:register.html');
}

require 'db_config.php';

?>
<!DOCTYPE html>
<html>

<head>
  <title>Home</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="Homestyle.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div class=".container">
    <div class="jumbotron text-center bg-warning">
      <a href="logout.php" class="float-right mr-2 font-weight-bold">Logout</a>
      <h1>Home Page</h1>
      <a href="usersPage.php" class=" float-right mr-0 font-weight-bold ">My Articles</a>
      <a href="home.php" class=" float-left mr-0 font-weight-bold ">Home Page</a>
    </div>
    <section class="float-right mr-2">
      <form action="#" method="POST">
        <input type="text" class="p-1" name="search_box" placeholder="Search...">
        <button class="p-1" name="home_search_submit">Search</button>
      </form>
      <h4 class="mt-3">Categories</h4>

      <?php

      $query = " SELECT category_id,category FROM categories ";
      $result = mysqli_query($conn, $query);
      if ($row = mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {

          echo "
    <ul>
    <li>
    <h6>
    <a href = 'home.php?category_id=" . $row['category_id'] . "' class = 'p-2 text-center'>" . $row['category'] . "</a>
    </h6>
    </li>
    </ul>";
        }
      }
      ?>
    </section>
    <div class="article_title ml-3 ">
      <h2>ALL ARTICLES TITLES</h2></br>
      <?php

      if (isset($_POST['home_search_submit'])) {
        $search = $_POST['search_box'];
        if (!empty($search)) {
          $query = "SELECT * FROM contents WHERE title LIKE '%$search%'";
          $result = mysqli_query($conn, $query);
          $queryResult = mysqli_num_rows($result);
          if ($queryResult > 0) {
            echo "<h3 class = 'ml-3 mt-1'>" . $queryResult . " result found " . "</h4></br>";
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
          echo 'window.location.href = "home.php"';
          echo '</script>';
        }
      } 
      else if (isset($_GET['category_id'])) {

        $var = $_GET['category_id'];
        $catQuery = "SELECT DISTINCT contents.article_id,contents.title FROM contents inner join category_article on contents.article_id = category_article.article_id JOIN categories ON category_article.category_id = '$var'";
        $catResult = mysqli_query($conn, $catQuery);
        $catAnotherResult = mysqli_num_rows($catResult);
        if ($catAnotherResult > 0) {
          while ($row = mysqli_fetch_assoc($catResult)) {

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

          echo "<h4> No title belong to this category </h4>";
        }
      } 
      else{

        // PRINT ALL THE ARTICLE TITLES ON THE HOME PAGE

        $query1 = "SELECT article_id, title FROM contents";
        $result1 = mysqli_query($conn, $query1);
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
      }

      ?>

    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>

</html>