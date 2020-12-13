<?php

require_once 'mydatabase.php';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location:login_page.php");
}

if (
    isset($_POST['username']) && isset($_POST['usercity']) && isset($_POST['useremail'])
    && isset($_POST['userbirth']) && isset($_POST['usergender']) && isset($_POST['userphone'])
) {

    $update_ary = []; //上傳資料用的陣列
    $update_ary[] = $_SESSION['user_id'];
    $update_ary[] = $_POST['username'];
    $update_ary[] = $_POST['usercity'];
    $update_ary[] = $_POST['useremail'];
    $update_ary[] = $_POST['usergender'];
    $update_ary[] = $_POST['uderphone'];
    $update_ary[] = $_POST['userbirth'];
    $update_ary[] = $_POST['username'];
    $update_ary[] = $_POST['usercity'];
    $update_ary[] = $_POST['useremail'];
    $update_ary[] = $_POST['usergender'];
    $update_ary[] = $_POST['uderphone'];
    $update_ary[] = $_POST['userbirth'];
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("INSERT INTO `user_detail`(`id`, `name`, `address`,`email`  ,`gender`, `phone`, `birthday`) 
    VALUES (?,?,?,?,?,?) ON DUPLICATE KEY 
    UPDATE `name` = ? , `address` = ? , `email` = ? , `gender` = ? , `phone` = ? , `birthday` = ? ");
    $stmt->execute($update_ary);
}


?>