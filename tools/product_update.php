<?php

if (isset($_POST['isshow']) && isset($_POST['product_id'])) {
    require_once '../mydatabase.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $conn->prepare("UPDATE attractions SET isshow = ? WHERE id = ? ");
    $statement->execute(array($_POST['isshow'],$_POST['product_id']));
}
