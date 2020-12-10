<!doctype html>
<html lang="zh-Hant">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style1.css">
    <title>登入介面</title>
    <style>
        body {
            height: 100vh;
            padding: 0;
            background-image: url(img/login-bg.jpg);
            background-size: cover;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include 'index_navbar.php';
    ?>

    <?php
    $error = '';
    $from = '';
    if (isset($_SESSION['wrong'])) $error =  $_SESSION['wrong'];
    if (isset($_GET['from'])) $from = $_GET['from'];
    $str = '<div class="container-fluid">
                <div class="d-flex justify-content-center h-100">
                    <div class="align-self-center login-panel">
                        <h2>帳號登入</h2>
                        <form action="login.php" method="POST" class="p-2 login_form">
                            <input type="text" name="from" hidden value="' . $from . '" class="w-100">
                            <div>
                                <label for="acnt" class="mb-0 mt-2">帳號</label>
                                <input type="text" name="acnt" autocomplete="off" class="w-100" required>
                            </div>
                            <div>
                                <label for="pwd" class="mb-0 mt-2">密碼</label>
                                <input type="password" name="pwd" autocomplete="off" class="w-100" required>
                            </div>
                            <div class="text-danger">' . $error . '</div>
                            <a href="create_account.php" class="float-right">註冊帳號</a>                
                            
                            <input type="submit" class="w-100 p-1 mt-4 btn btn-primary ">
                        </form>
                    </div>
                </div>
            </div>';
    if (isset($_SESSION['user_id'])) {
        if (isset($_GET['from'])) {
            header("Location:" . $_GET['from']);
        } else {
            header("Location:login_profile.php");
        }
    } else {
        echo $str;
    }
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>