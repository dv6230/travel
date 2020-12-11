<?php
session_start();
require_once 'mydatabase.php';

if (!isset($_GET['pid'])) {
    header("Location:show_product.php");
}

if (!isset($_SESSION['user_id'])) header("Location:login_page.php?from=" . $_SERVER['REQUEST_URI']);

$title = '';
$content = '';
$price = '';
$image_name = '';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT * FROM attractions WHERE id = ? AND isshow = true");
$stmt->execute([$_GET['pid']]);
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
foreach ($stmt as $row) {        
    $title = $row['title'];
    $content = $row['content'];
    $price = $row['price'];
    $image_name = $row['image_name'];
}
$result = null;

?>

<!doctype html>
<html lang="zh-Hant">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/style5.css">

    <title>產品購買</title>
</head>

<body>
    <?php include 'index_navbar.php'; ?>

    <div class="container" class="">
        <div class="pt-5"></div>
        <h1 class="mb-5">產品購買</h1>

        <ul>
            <li>
                <ul class="row prd-border pl-5 ul-title">
                    <li class="col-9 h3 ">產品名稱</li>
                    <li class="col-3 h3">單價</li>
                </ul>
            </li>
            <li>
                <ul class="row ul-content p-5 ">
                    <li class="col-9 h4 "><?php echo $title ?></li>
                    <li class="col-3 h4 d-inline-block ml-auto text-right"><?php echo $price ?> 元</li>
                </ul>
            </li>
            <li>
                <ul class="row ul-footer pl-5 pr-5 pt-3">
                    <li class="col-9 h4 ">總計</li>
                    <li class="col-3 h4 d-inline-block ml-auto text-right text-success">NT$ <?php echo $price ?></li>
                </ul>
            </li>
        </ul>
        <div class="mt-5 p-0">
            <h3>付款方式</h3>
            <!----
            <div class="card pay-border">
                <div class="card-body">
                    <h3 class="card-title">刷卡</h3>
                </div>
            </div>
            <div class="card pay-border">
                <div class="card-body">
                    <h3 class="card-title">付現金</h3>
                </div>
            </div>
            --->
            <form action="deal_purchare.php" class="mt-5" method="POST">
                <input type="text" hidden name="shopping" value="<?php echo $_GET['pid'] ?>" >
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">持卡人姓名</label>
                        <input type="text" class="form-control form-bdr" id="cc-name" placeholder="" required>

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">信用卡卡號</label>
                        <input type="text" class="form-control form-bdr" id="cc-number" placeholder="" required>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">

                        <label for="cc-expiration" class="w-100">信用卡日期</label>

                        <div class="col-7 d-inline-block p-0">
                            <select class="custom-select form-bdr" id="year_select">
                                <option selected>年份</option>
                            </select>
                        </div>
                        <div class="col-4 d-inline-block p-0">
                            <select class="custom-select form-bdr" id="month_select">
                                <option selected> 月份</option>
                            </select>
                        </div>


                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">信用卡末三碼</label>
                        <input type="text" class="form-control form-bdr" id="cc-cvv" placeholder="" required>

                    </div>
                </div>
                <hr class="mb-4">
                <div class='d-flex justify-content-center'>
                    <button class="btn btn-primary btn-lg " type="submit">確認下單</button>
                </div>
            </form>

        </div>
    </div>

    <footer></footer>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script>
        for (var i = 2020; i < 2031; i++) {
            $('#year_select').append($("<option></option>").text(i));
        }
        for (var i = 1; i < 13; i++) {
            $('#month_select').append($("<option></option>").text(i));
        }
    </script>
</body>

</html>