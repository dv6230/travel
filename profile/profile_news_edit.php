<?php

session_start();
if (!isset($_SESSION['user_id'])) header("Location:http://localhost/travel/login_page.php");
$user_id = $_SESSION['user_id'];
//權限大於0可以操作
if (isset($_SESSION['auth'])) {
    $auth = (int)$_SESSION['auth'];
}
if (!($auth > 0)) {
    header("Location:profile_center.php");
}
(isset($_POST['article_id'])) ? $article_id = $_POST['article_id'] : header("Location:profile_center.php");

include '../mydatabase.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT title,content,theme FROM article WHERE id = $article_id");
$stmt->execute();
// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$row = $stmt->fetch();
$title = $row['title'];
$content = $row['content'];
$GLOBALS['theme'] = $row['theme'];

$conn = null;

?>

<!doctype html>
<html lang="zh-Hant">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style1.css">
    <title>編輯</title>
</head>

<body>
    <?php include '../index_navbar.php'; ?>

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="http://localhost/travel/login_profile.php?type=center">會員中心</a></li>
                <li class="breadcrumb-item"><a href="http://localhost/travel/login_profile.php?type=else">其他</a></li>
                <li class="breadcrumb-item"><a href="http://localhost/travel/profile/profile_news_manage.php">消息管理</a></li>
                <li class="breadcrumb-item active" aria-current="page">編輯</li>
            </ol>
        </nav>

        <h2 class="m-4">文章編輯</h2>


        <form action="profile_news_update.php" method="POST" class="m-5">
            <input type="text" value="<?php echo $article_id ?>" hidden name="article_id">
            <div class="form-group">
                <label for="title">標題</label>
                <input type="text" class="form-control" value="<?php echo $title ?>" id="title" aria-describedby="標題" name="title" required>
            </div>
            <div class="form-group">
                <label for="a_content">內容描述</label>
                <textarea class="form-control" id="a_content" rows="10" name="text_content" required><?php echo $content ?></textarea>
            </div>

            <div class="m-2">

                <?php
                $theme_array = array('活動', '新聞', '介紹', '焦點', '其他');
                $i = 0;
                function issame($str)
                {
                    if ($str == $GLOBALS['theme']) echo 'checked';
                }
                foreach ($theme_array as $value) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="<?php echo $value ?>" value="<?php echo $value ?>" <?php issame($value) ?> name="theme">
                        <label class="form-check-label" for="<?php echo $value ?>">
                            <?php echo $value ?>
                        </label>
                    </div>
                <?php
                endforeach;
                ?>

                <button type="submit" class="btn btn-primary">送出</button>

        </form>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>