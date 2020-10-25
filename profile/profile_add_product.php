<?php
/*
session_start();
$web = "http://". $_SERVER['SERVER_NAME'] ."/travel/login_profile.php";
if (!isset($_SESSION['id'])) header("Location:$web");
$user_id = $_SESSION['id'];
//權限大於0可以操作
if (isset($_SESSION['auth'])) {
    $auth = (int)$_SESSION['auth'];
}
if (!($auth > 0)) {
    header("$web");
}
*/
include '../mydatabase.php';

?>

<!doctype html>
<html lang="en">

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
    </style>
</head>

<body>
    <?php include '../index_navbar.php'; ?>

    <div class="container d-flex justify-content-center ">

        <!-- Material form login -->
        <div class="card mt-5 col-md-8">
            <h2 class="card-header info-color white-text text-center py-4 m-0 p-0 success-color">
                景點登入
            </h2>
            <!--Card content-->
            <div class="card-body px-lg-5 pt-0">
                <!-- Form -->
                <form class="text-center" style="color:#33b5e5;" action="profile_add_product.php" method="POST" enctype="multipart/form-data">
                    <!-- Email -->
                    <div class="md-form">
                        <input type="email" id="materialLoginFormEmail" class="form-control h2">
                        <label for="materialLoginFormEmail h2">標題</label>
                    </div>
                    <!-- TextArea -->
                    <div class="form-group purple-border ">
                        <label for="exampleFormControlTextarea4" class="text-dark">內容描述</label>
                        <textarea class="form-control" id="exampleFormControlTextarea4" rows="9 "></textarea>
                    </div>
                    
                    <!-- Drag and drop file upload 
                    <div class="file-upload-wrapper">
                        <label for="input-file-now" class="text-dark">上傳圖片</label>
                        <br>
                        <input type="file" id="input-file-now" class="file-upload " />
                    </div>
                    -->

                    <fieldset>
                        <legend>HTML File Upload</legend>

                        <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />

                        <div>
                            <label for="fileselect">Files to upload:</label>
                            <input type="file" id="fileselect" name="fileselect[]" multiple="multiple" />
                            <div id="filedrag">or drop files here</div>
                        </div>

                        <div id="submitbutton">
                            <button type="submit">Upload Files</button>
                        </div>

                    </fieldset>

                    <!-- Sign in button -->
                    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">上傳</button>
                </form>
                <!-- Form -->
            </div>
        </div>
        <!-- Material form login -->

    </div>

    <script>

    </script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
</body>

</html>