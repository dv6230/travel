<?php

session_start();
if (!isset($_SESSION['id'])) header("Location:login_page.php");
$user_id = $_SESSION['id'];
//權限大於0可以操作
if (isset($_SESSION['auth'])) {
    $auth = (int)$_SESSION['auth'];
}
if (!($auth > 0)) {
    header("Location:profile_center.php");
}

include '../mydatabase.php';


if (isset($_POST['title']) && isset($_POST['text_content']) && isset($_POST['theme']) && isset($_POST['article_id'])) {
    try {

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE article SET title = ? , content = ? , theme = ? WHERE id = ?";
        // Prepare statement
        $stmt = $conn->prepare($sql);
        // execute the query
        $stmt->execute([$_POST['title'], $_POST['text_content'], $_POST['theme'], $_POST['article_id']]);

    } catch (PDOException $e) {
        echo '失敗, 錯誤原因' . $e->getMessage();
    }
    header("Location:profile_news_manage.php");
}
else{
    header("Location:profile_center.php");
}


