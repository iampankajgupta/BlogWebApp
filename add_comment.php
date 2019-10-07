<?php
session_start();
$connect = new PDO('mysql:host=localhost;dbname=blog','root','');
$error = '';
$comment_content = '';
$user_id = $_SESSION['userid'];
$article_id = $_GET['article_id'];
if(empty($_POST['comment_content'])){
    $error .='<p class ="text-danger">Comment is Required</p>';
}else{
    $comment_content = $_POST['comment_content'];
}
if($error == ''){
    $query = "INSERT INTO comments(user_id,article_id,comment)VALUES(:user_id,:article_id,:comment_content)";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            'user_id' => $user_id,
            'article_id' => $article_id,
            'comment' => $comment_content

        )
        );
    $error = '<label class="text-success">Comment Added</label>';

}
$data = array(
    'error' => $error
);

echo json_encode($data);

?>