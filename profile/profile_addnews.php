<?php

session_start();
if (!isset($_SESSION['user_id'])) header("Location:login_page.php");
$user_id = $_SESSION['user_id'];
//權限大於0可以操作
if (isset($_SESSION['auth'])) {
    $auth = (int)$_SESSION['auth'];
}
if (!($auth > 0)) {
    header("Location:profile_center.php");
}

include '../mydatabase.php';

//防止頁面刷新後重複傳送表單
if (!isset($_SESSION['decide'])) {
    $_SESSION['decide'] = 0;
}

/*
防止使用者按下 重新整理 表單送出上一筆資料

操作邏輯 : 當頁面重新整理時，網頁送出的內容為之前送出的內容，所以 HTML 表單內的 
<input  name="decide" value="<?php echo $_SESSION['decide']; ?>">
是上一筆資料的 $_SESSION['decide'] 數值 ， 如果使用者按下送出
則會送出目前 $_SESSION['decide'] 的 數值

*/

//$_SESSION['decide']==$_POST['decide'] 檢視如果 裡面的數值相同則處理表單  
if (isset($_POST['title']) && isset($_POST['text_content']) && isset($_POST['theme']) && $_SESSION['decide'] == $_POST['decide']) {

    //計數器 ++
    $_SESSION['decide'] += 1;

    $title = $_POST['title'];
    $content = $_POST['text_content'];
    $theme = $_POST['theme'];
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO article (title,content,theme) VALUES (?,?,?)";
    $conn = $conn->prepare($sql);
    $conn->execute([$title, $content, $theme]);
    $conn = null;
    $srv = $_SERVER['SERVER_NAME'];
    //header("Location:../login_profile.php?type=else");   

}


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
    <title>新增消息</title>
</head>

<body>

    <?php include '../index_navbar.php'; ?>

    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="http://localhost/travel/login_profile.php?type=center">會員中心</a></li>
                <li class="breadcrumb-item"><a href="http://localhost/travel/login_profile.php?type=else">其他</a></li>
                <li class="breadcrumb-item active" aria-current="page">新增消息</li>
            </ol>
        </nav>
        <h2 class="m-4">新增消息</h2>
        <form action="profile_addnews.php" method="POST" class="m-5">

            <!-- 表單計數器 -- 防止重新整理重複發送表單 -->
            <input type="hidden" name="decide" value="<?php echo $_SESSION['decide']; ?>">
            <!-- END -->

            <div class="form-group">
                <label for="title">標題</label>
                <input type="text" class="form-control" id="title" aria-describedby="標題" name="title" required>
            </div>
            <div class="form-group">
                <label for="a_content">內容描述</label>
                <textarea class="form-control" id="a_content" rows="10" name="text_content" required></textarea>
            </div>

            <div class="m-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="Radios1" value="活動" checked name="theme">
                    <label class="form-check-label" for="Radios1">
                        活動
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="Radios2" value="新聞" name="theme">
                    <label class="form-check-label" for="Radios2">
                        新聞
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="Radios3" value="介紹" name="theme">
                    <label class="form-check-label" for="Radios3">
                        介紹
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="Radios4" value="焦點" name="theme">
                    <label class="form-check-label" for="Radios4">
                        焦點
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="Radios5" value="其他" name="theme">
                    <label class="form-check-label" for="Radios5">
                        其他
                    </label>
                </div>
            </div>

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