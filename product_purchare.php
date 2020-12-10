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
                    <li class="col-6 h3 ">產品名稱</li>
                    <li class="col-3 h3 ">單價</li>
                </ul>
            </li>
            <li>
                <ul class="row ul-content p-5 ">
                    <li class="col-6 h4 "><?php echo $title ?></li>
                    <li class="col-3 h4 d-inline-block ml-auto text-right"><?php echo $price ?>  元</li>
                </ul>
            </li>
        </ul>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>