<?php

session_start();

$web = "http://". $_SERVER['SERVER_NAME'] ."/travel/login_profile.php";
if (!isset($_SESSION['user_id'])) header("Location:$web");
$user_id = $_SESSION['user_id'];
//權限大於0可以操作
if (isset($_SESSION['auth'])) {
    $auth = (int)$_SESSION['auth'];
}
if (!($auth > 0)) {
    header("Location:profile_center.php");
}


require '../mydatabase.php';
require '../tools/manager_product_upload.php';

//預設參數
$rturn = '';
$title = '';
$content = '';
$price = '';


//防止頁面刷新後重複傳送表單
if (!isset($_SESSION['decide_add_product'])) {
    $_SESSION['decide_add_product'] = 0;
}
function checkpostandsession()
{
    if ($_SESSION['decide_add_product'] == $_POST['decide_add_product']) {
        return true;
    } else {
        return false;
    }
}
//--------------------------------

// 單位換算 5MB -> 5 * 1024 * 1024 bytes
if (isset($_POST['title']) && isset($_POST['content'])  && isset($_POST['price']) && $_FILES && $_FILES["image"]["size"] < 5242880 && checkpostandsession()) {

    $process_file = new manager_product_upload();
    $rturn = $process_file->process_file($_FILES); //成功:'' ; 失敗:'無法上傳此類型的檔案';
    if ($rturn != '無法上傳此類型的檔案') {  //支援的檔案

        //計數器 ++
        $_SESSION['decide_add_product'] += 1;

        $title = $_POST['title'];
        $content = $_POST['content'];
        $price = $_POST['price'];

        $process_file->process_content($title, $content, $rturn, $price);
        $title = '';
        $content = '';
        $price = '';
        $rturn = '';
    } else { //不支援的檔案         
        $title = $_POST['title'];
        $content = $_POST['content'];
        $price = $_POST['price'];
    }
    //header('Location: profile_add_product.php');
} else if ($_FILES && $_FILES["image"]["size"] >= 5242880) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $price = $_POST['price'];
    $rturn = '檔案過大';
}

?>

<!doctype html>
<html lang="zh-Hant">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>新增旅遊路徑</title>
    <style>
        nav.navbar {
            background-color: rgba(10, 10, 10, 0.9);
        }

        .upload_img {
            border: 2px solid black;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php include '../index_navbar.php'; ?>

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="http://localhost/travel/login_profile.php?type=center">會員中心</a></li>
                <li class="breadcrumb-item"><a href="http://localhost/travel/login_profile.php?type=else">其他</a></li>
                <li class="breadcrumb-item active" aria-current="page">新增產品</li>
            </ol>
        </nav>
        <!-- Material form login -->
        <div class="w-100 d-flex justify-content-center">
            <div class="card col-md-8 d-flex justify-content-center ">
                <h2 class="card-header info-color white-text text-center py-4 m-0 p-0 success-color">
                    景點登入
                </h2>
                <!--Card content-->
                <div class="card-body px-lg-5 pt-0">
                    <!-- Form -->
                    <form class="text-center" style="color:#33b5e5;" action="profile_add_product.php" method="POST" enctype="multipart/form-data">

                        <!-- 表單計數器 -- 防止重新整理重複發送表單 -->
                        <input type="hidden" name="decide_add_product" value="<?php echo $_SESSION['decide_add_product']; ?>">
                        <!-- END -->

                        <!-- Title -->
                        <div class="md-form">
                            <input value="<?php echo $title ?>" type="text" id="materialLoginFormEmail" class="form-control h2" name="title" required>
                            <label for="materialLoginFormEmail h2">標題</label>
                        </div>
                        <!-- TextArea -->
                        <div class="form-group purple-border ">
                            <label for="exampleFormControlTextarea4" class="text-dark">內容描述</label>
                            <textarea class="form-control" id="exampleFormControlTextarea4" rows="9" name="content" required><?php echo $content ?></textarea>
                        </div>
                        <!-- Price -->
                        <div class="md-form">
                            <input value="<?php echo $price ?>" type="number" id="materialLoginFormPrice" class="form-control h2" name="price" required>
                            <label for="materialLoginFormPrice h2">價錢</label>
                        </div>
                        <!-- Drag and drop file upload -->
                        <div class="file-upload-wrapper text-dark">
                            <label for="input-file-now" class="text-dark">上傳圖片(支援jpg、png；不可超過5MB)</label>
                            <br>
                            <input type="file" id="input-file-now" class="file-upload upload_img w-100" name="image" required />
                        </div>
                        <p class="text-danger"><?php echo $rturn; ?></p>
                        <!-- Sign in button -->
                        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">上傳</button>
                    </form>
                    <!-- Form -->
                </div>
            </div>
        </div>

        <!-- Material form login -->

    </div>


    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
</body>

</html>