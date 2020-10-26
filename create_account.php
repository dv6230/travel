<?php

$name_error = false;
$create_success = false;
if (isset($_POST['acnt']) && isset($_POST['pwd'])) {
    $user_name = $_POST['acnt'];
    $user_password = $_POST['pwd'];
    require_once 'mydatabase.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT account FROM user WHERE account = $user_name";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $name_error = true;
    } else {
        $sql = "INSERT INTO user (account,password) VALUES ($user_name,$user_password)";
        if ($conn->query($sql) === TRUE) {
            $create_success = true;
        }
        $conn->close();
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>註冊帳號</title>
    <style>
        body {
            /*
            background: rgb(174, 238, 208);
            background: radial-gradient(circle, rgba(174, 238, 208, 0.8354692218684349) 0%, rgba(73, 119, 255, 0) 100%);
            */
            background: #b3e0ff;
        }

        .b {
            height: 100vh;
        }


        .panel-shadow {
            border: none;
            box-shadow: 5px 10px 18px #888888;
        }


        img {
            width: 100%;
            height: 100%;
            margin-left: auto;
            margin-right: auto;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .hdi {
                visibility: hidden;
                height: 0px;
                margin: 0px;
            }

            .panel-shadow {
                border: none;
                box-shadow: 0px 0px 0px 0px;
            }

            .rwd_padding {
                padding: 50px;
                margin: 0px;
            }
        }

        .card-size{
            width: 320px;
        }
    </style>
</head>

<body>

    <div class="container b p-2">
        <div class="row d-flex align-items-center h-100">
            <div class="row panel-shadow bg-light p-0 rwd_padding">
                <div class="col-md-7 m-0 p-0 hdi">
                    <img src="img/p1.jpg" alt="" class="m-0 p-0">
                </div>
                <div class="col-md-5">
                    <form id="form1" name="form1" class="d-flex flex-column pl-3 pr-3 mt-2 mb-3" method="POST" action="create_account.php">
                        <div>
                            <a href="javascript:history.back()" class="float-right m-2 d-inline">返回</a>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <h3>註冊帳號</h3>
                                <label for="useraccount">帳號</label>
                                <input type="text" class="form-control" name="acnt" id="useraccount" placeholder="Account" required>
                            </div>
                            <div class="form-group">
                                <label for="pass1">密碼</label>
                                <input type="password" class="form-control" name="pwd" id="pass1" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="pass2">再次輸入密碼</label>
                                <input type="password" class="form-control" id="pass2" placeholder="Password" required>
                            </div>
                            <div id="notsame">
                            </div>
                        </div>

                        <?php
                        if ($name_error) {
                            echo '<p class="text-danger">此帳號已被使用</p>';
                        } else {
                            echo '<br>';
                        }
                        ?>
                        <button type="submit" class="btn btn-primary w-50 m-auto" id="sub">註冊</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered card-size">
            <div class="modal-content">
                <div class="modal-header border-0 d-flex align-items-center mt-4">
                    <h2 class="text-center w-100">註冊成功</h2>
                </div>
                <div class="modal-body d-flex justify-content-center m-5 ">
                    <img src="img/check.png" class="" width="96px" height="96px" alt="...">
                </div>
                <div class="modal-footer border-0">
                    <a href="login_page.php" class="btn btn-primary w-100 mt-3">前往登入</a>

                </div>
            </div>
        </div>
    </div>




    <script>
        document.getElementById("sub").addEventListener("click", function(event) {
            event.preventDefault();
            var ps1 = document.getElementById("pass1").value;
            var ps2 = document.getElementById("pass2").value;
            if (ps1 === ps2) {

                document.form1.submit();

            } else {
                var str = document.getElementById("notsame").innerHTML = "密碼輸入錯誤";
            }
        });

        <?php

        if ($create_success) {
            echo " $(document).ready(function() {
                $('#myModal').modal('show');
            });";
        }
        ?>
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>