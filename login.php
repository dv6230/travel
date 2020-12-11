<?php
session_start();
require_once 'mydatabase.php';
if (isset($_POST['acnt']) && isset($_POST['pwd'])) {

    $conn = new mysqli($servername, $username, $password, $dbname);

    $usr = $conn->real_escape_string($_POST['acnt']);
    $pwd = $conn->real_escape_string($_POST['pwd']);

    $sql = "SELECT id , password , auth FROM user WHERE account = '$usr' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $row = $result->fetch_assoc();
        if ($row["password"] == $pwd) {
            echo '成功登入';
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['auth'] = $row['auth'];

            if (empty($_POST['from'])) {
                header('Location:login_page.php');
            } else {
                echo "<script>location.href='" . $_POST['from'] . "';</script>";
            }
        } else {
            $_SESSION['wrong'] = '帳號或密碼輸入錯誤';
            header('Location:login_page.php');
        }
    } else {
        $_SESSION['wrong'] = "帳號或密碼輸入錯誤";

        header('Location:login_page.php');
    }
    $conn->close();
} else {
    header('Location:login_page.php');
}
