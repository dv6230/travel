<?php
session_start();
require_once 'mydatabase.php';

if (!isset($_GET['pid'])) {
    header("Location:show_product.php");
}


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
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style5.css">
    <title>產品介紹</title>
</head>

<body>
    <?php include 'index_navbar.php'; ?>
    <div class="container">
        <div>
            <a href="javascript:history.back()" class="m-2 d-inline-block">返回</a>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <h1><?php echo $title ?></h1>
                <div class="p-2"></div>
                <h3 class="d-inline">售價 <?php echo $price ?></h3>
                <a href="<?php echo 'product_purchare.php?pid='.$_GET['pid'] ?>" class="btn btn-danger float-right">前往下單</a>

            </div>
            <div class="col-md-8">
                <p class="mt-5 p-3"><?php echo $content ?></p>
                <img src="<?php echo 'product_image/' . $image_name ?>" alt="" class="w-100">
            </div>
        </div>
    </div>
    <div class="p-3"></div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>