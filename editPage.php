<?php
session_start();
require 'db_config.php';
$article_id = $_GET['article_id'];
$query = "SELECT * FROM contents WHERE article_id = '$article_id'";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $title = $row['title'];
    $article = $row['article'];
}

$category_query = "SELECT * FROM categories";
$category_result = mysqli_query($conn, $category_query);

// $get_category = "SELECT DISTINCT categories.category FROM categories JOIN category_article ON categories.category_id=category_article.category_id WHERE category_article.article_id='$article_id'";
$get_category = "select category_id from category_article where article_id=$article_id";
$get_cat_result = mysqli_query($conn, $get_category);

//  APPENDING ALL SELECTED CATEGORIES INTO AN ARRAY
$article_categories = [];
while ($get_category_row = mysqli_fetch_array($get_cat_result)) {
    array_push($article_categories, $get_category_row['category_id']);
}

// DISPLAYING SELECTED AS WELL AS NON SELECTED CATEGORY IN CATEGORY

$cat = '';
while ($cat_row = mysqli_fetch_array($category_result)) {
    $cat .= '<option ';
    if (in_array($cat_row["category_id"], $article_categories)) {
        $cat .= 'selected = "selected"';
    }
    $cat .= ' value="' . $cat_row["category_id"] . '">' . $cat_row["category"] . '</option>';
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Create Blog </title>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="image_handler.js"></script>
    <link rel="stylesheet" type="text/css" href="index_stylesheet.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class=".container">
        <div class="jumbotron text-center ">
            <h1>Edit Page</h1>
            <a href="home.php" class="float-right font-weight-bold">Go To Home</a>
        </div>
        <form action="inc/actions.php?action=update" method="POST">
            <div class="form-group ">
                <label id="title" for="title">Title:</label>
                <input type="text" class="form-control" name="updateTitle" placeholder="Title..." required="" value="<?php echo $title ?>">
            </div>
            <div class="form-group">
                <label id="category" for="title">Category:</label>
                <select class="js-example-basic-multiple form-control " name="states[]" multiple="multiple">
                    <?php echo $cat;?>
                </select>
            </div>

            <textarea name="updateEditor_text" id="mytextarea"><?php echo $article ?></textarea>
            <button class="btn btn-warning pl-4 pr-4" id="pst_btn" type="submit" name="post">Update</button>
        </form>
    </div>

    <!-- <textarea  name = "Comments"placeholder="Comments...."></textarea> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link href="styles/select2.min.css" rel="stylesheet" />
    <script src="scripts/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            $(".js-example-tags").select2({
                tags: true
            });

        });
    </script>
</body>

</html>