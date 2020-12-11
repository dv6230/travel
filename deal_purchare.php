<?php
session_start();
require_once 'mydatabase.php';
if (!isset($_SESSION['user_id'])) header("Location:index.php");
if (isset($_POST['shopping'])) {
    $buy_item_id = $_POST['shopping'];
    $buyer_id = $_SESSION['user_id'];
    $item_price = '' ;

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT price FROM attractions WHERE id = ?");
    $stmt->execute([$buy_item_id]);
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach($stmt as $value){
        $item_price = $value['price'];
    }

    $stmt = $conn->prepare("INSERT INTO transaction (product_id,price,buyer_id) VALUE (?,?,?)");
    $stmt->execute([$buy_item_id,$item_price,$buyer_id]);    
    echo '成功';
} else {
    header("Location:index.php");
}
