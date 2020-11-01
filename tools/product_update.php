<?php

//驗證
session_start();
if (isset($_SESSION['auth'])) {
    $auth = (int)$_SESSION['auth'];
}
if (!($auth > 0)) {
    header("Location:profile_center.php");
}

if (isset($_POST['isshow']) && isset($_POST['product_id'])&&$auth >0) {
    $isshow = $_POST['isshow'];
    $product_id = $_POST['product_id'];

    require_once '../mydatabase.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $conn->prepare("UPDATE attractions SET isshow = ? WHERE id = ? ");
    $statement->execute(array($isshow, $product_id));
}
