<?php
session_start();
require_once 'mydatabase.php';
if (isset($_POST['acnt']) && isset($_POST['pwd'])) {

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $usr = $conn->real_escape_string($_POST['acnt']);
    $pwd = $conn->real_escape_string($_POST['pwd']);

    $sql = "SELECT id , password , name , auth FROM user WHERE account = '$usr' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["password"] == $pwd) {
                echo '成功登入';
                $_SESSION['id'] = $row['id'];
                $_SESSION['auth'] = $row['auth'];
                header('Location:login_page.php');
            } else {
                $_SESSION['wrong'] = '<p class="w-100 text-danger">帳號或密碼輸入錯誤</p>';
                header('Location:login_page.php');
            }
        }
    } else {
        $_SESSION['wrong'] = '帳號或密碼輸入錯誤';
        header('Location:login_page.php');
    }
    $conn->close();
} else {
    header('Location:login_page.php');
}
