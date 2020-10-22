<?php

$name_error = false;

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
        $sql = "INSERT INTO user (account,password) VALUES ($user_account,$user_password)";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
        header("Location:index.php");
        echo '1234564878';
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

    <title>註冊帳號</title>
    <style>
        body {

            background: rgb(174, 238, 208);
            background: radial-gradient(circle, rgba(174, 238, 208, 0.8354692218684349) 0%, rgba(73, 119, 255, 0) 100%);

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
    </style>
</head>

<body>

    <div class="container-fluid b p-2">
        <div class="row d-flex align-items-center h-100">
            <div class="row panel-shadow bg-light p-0 rwd_padding">
                <div class="col-md-7 m-0 p-0 hdi">
                    <img src="img/p1.jpg" alt="" class="m-0 p-0">
                </div>
                <div class="col-md-5">
                    <form class="d-flex flex-column pl-3 pr-3 mt-2 mb-3">
                        <div>
                            <a href="javascript:history.back()" class="float-right m-2 d-inline">返回</a>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <h3>註冊帳號</h3>
                                <label for="exampleInput1">帳號</label>
                                <input type="text" class="form-control" name="acnt" id="exampleInput1" placeholder="Account" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInput2">密碼</label>
                                <input type="password" class="form-control" name="pwd" id="exampleInput12" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInput3">再次輸入密碼</label>
                                <input type="password" class="form-control" id="exampleInput13" placeholder="Password" required>
                            </div>
                        </div>

                        <?php
                        if ($name_error) {
                            echo '<p class="text-danger">此帳號已被使用</p>';
                        } else {
                            echo '<br>';
                        }
                        ?>
                        <button type="submit" class="btn btn-primary w-50 m-auto">註冊</button>


                    </form>
                </div>
            </div>

        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>