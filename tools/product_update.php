<?php
//產品資料更新 (顯示、刪除)

//驗證
session_start();
if (isset($_SESSION['auth'])) {
    $auth = (int)$_SESSION['auth'];
}
if (!($auth > 0)) {
    header("Location:profile_center.php");
}


//產品是否顯示
if (isset($_POST['isshow']) && isset($_POST['product_id']) && $auth > 0) {
    $isshow = $_POST['isshow'];
    $product_id = $_POST['product_id'];

    require_once '../mydatabase.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $conn->prepare("UPDATE attractions SET isshow = ? WHERE id = ? ");
    $statement->execute(array($isshow, $product_id));
}


//產品刪除
if (isset($_POST['del'])) {
    require_once '../mydatabase.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pid = $_POST['del'];

    $sql = "SELECT * FROM `attractions` WHERE id = $pid ";
    $statement = $conn->query($sql);
    $result = $statement->fetchALL(PDO::FETCH_ASSOC);

    $image_name = '123';
    foreach ($result as $row) {
        $image_name = $row['image_name'];
    }
    unlink('../product_image/'.$image_name);
    
    $statement = $conn->prepare("DELETE FROM `attractions` WHERE id = ?");
    $statement->execute(array($_POST['del']));
    
}
