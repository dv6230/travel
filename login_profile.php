<?php session_start();

if (!isset($_SESSION['user_id'])) header("Location:login_page.php");
require 'tools/path_classify.php';
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style2.css">
  <title>會員中心</title>
  <style>
    .navbar {
      background-color: rgba(10, 10, 10, 0.9);
    }
  </style>
</head>

<body>
  <?php
  require_once 'index_navbar.php';
  ?>
  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-md-2 ">
        <ul class="list-group">
          <li class="list-group-item"><a href="login_profile.php?type=center" class="">會員中心</a></li>
          <li class="list-group-item"><a href="login_profile.php?type=order" class="">訂單資料</a></li>
          <li class="list-group-item"><a href="login_profile.php?type=history" class="">歷史紀錄</a></li>
          <?php
          //權限大於0可以操作
          if (isset($_SESSION['auth'])) {
            $auth = (int)$_SESSION['auth'];
            if ($auth > 0) {
              $str = '<li class="list-group-item"><a href="login_profile.php?type=else" class="">其他</a></li>';
              echo $str;
            }
          }

          ?>
          <li class="list-group-item"><a href="login_profile.php?type=person" class="">個人資料</a></li>
        </ul>
      </div>
      <div class="col-md-9">
        <div class="content w-100">
          <?php
          $path = new backstage();
          if (isset($_GET['type'])) {
            $tp = $_GET['type'];
            $path->getbackstage($tp, $auth);
            $website = $path->getbackstage($tp, $auth);
            require $website;
          } else {
            header("Location:login_profile.php?type=center");
          }
          ?>
        </div>
      </div>
    </div>

  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>