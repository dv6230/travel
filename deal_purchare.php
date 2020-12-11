<?php
session_start();
require_once 'mydatabase.php';
$success = false;
if (!isset($_SESSION['user_id'])) header("Location:index.php");
if (isset($_POST['shopping'])) {
    $buy_item_id = $_POST['shopping'];
    $buyer_id = $_SESSION['user_id'];
    $item_price = '';

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT price FROM attractions WHERE id = ?");
    $stmt->execute([$buy_item_id]);
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach ($stmt as $value) {
        $item_price = $value['price'];
    }
    /*
    $stmt = $conn->prepare("INSERT INTO transaction (product_id,price,buyer_id) VALUE (?,?,?)");
    $stmt->execute([$buy_item_id, $item_price, $buyer_id]);
    */
    $success = true;
} else {
    header("Location:index.php");
}

?>

<!doctype html>
<html lang="zh">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <title>訂購回報</title>
    <style>
        .bg-lightgreen {
            background-color: rgb(0, 165, 0);
            color: white;
        }

        .bg-err {
            background-color: rgb(220, 0, 0);
            color: white;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center">
        <?php if ($success == true) { ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <img src="https://www.flaticon.com/svg/static/icons/svg/390/390973.svg" class="m-3 text-center d-inline w-100 " height="64px" alt="">
                        </div>
                        <div class="modal-body">
                            <h5 class="modal-title text-center w-100 h1" id="exampleModalLabel">成功</h5>
                            <h5 class="mt-5 text-center">
                                訂購成功，點擊確認跳轉頁面
                            </h5>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="col-md-6 m-auto btn bg-lightgreen">確認</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else if ($success == false) { ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <img src="https://www.flaticon.com/svg/static/icons/svg/463/463612.svg" class="m-3 text-center d-inline w-100 " height="64px" alt="">
                        </div>
                        <div class="modal-body">
                            <h5 class="modal-title text-center w-100 h1" id="exampleModalLabe1">失敗</h5>
                            <h5 class="mt-5 text-center">
                                訂購失敗，請聯繫課服人員 電話 0912-345-987
                            </h5>
                        </div>
                        <div class="modal-footer">
                            <a href="index.php" class="col-md-6 m-auto btn bg-err">確認</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>





    <script>
        $(document).ready(function() {
            $("#exampleModal").modal('show');

            $('#exampleModal').modal({
                backdrop: 'static',
                keyboard: false
            });

        });
    </script>

</body>

</html>