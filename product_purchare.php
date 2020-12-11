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
            <form action="">
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="credit">Credit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                        <label class="custom-control-label" for="debit">Debit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                        <label class="custom-control-label" for="paypal">Paypal</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Name on card</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required>
                        <small class="text-muted">Full name as displayed on card</small>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Credit card number</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required>
                        <div class="invalid-feedback">
                            Credit card number is required
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Expiration</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                        <div class="invalid-feedback">
                            Expiration date required
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                        <div class="invalid-feedback">
                            Security code required
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <div class='d-flex justify-content-center'>
                    <button class="btn btn-primary btn-lg " type="submit">Continue to checkout</button>
                </div>
            </form>

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>