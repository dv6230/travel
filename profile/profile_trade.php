<?php

session_start();
if (!isset($_SESSION['user_id'])) header("Location:login_page.php");
$user_id = $_SESSION['user_id'];
//權限大於0可以操作
if (isset($_SESSION['auth'])) {
    $auth = (int)$_SESSION['auth'];
}
if (!($auth > 0)) {
    header("Location:profile_center.php");
}

include '../mydatabase.php';

?>

<!doctype html>
<html lang="zh-Hant">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style1.css">
    <title>客戶交易紀錄</title>
</head>

<body>

    <?php include '../index_navbar.php'; ?>

    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="http://localhost/travel/login_profile.php?type=center">會員中心</a></li>
                <li class="breadcrumb-item"><a href="http://localhost/travel/login_profile.php?type=else">其他</a></li>
                <li class="breadcrumb-item active" aria-current="page">客戶交易紀錄</li>
            </ol>
        </nav>
        <h2 class="m-4">客戶交易紀錄</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">編號</th>
                    <th scope="col">名稱</th>
                    <th scope="col">日期</th>
                    <th scope="col">價錢</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM transaction WHERE 1 ORDER BY date DESC , id ASC ");
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach ($stmt as $row) {
                    echo "<tr>
             <th scope='row'>" . $row['id'] . "</th>
             <td>" . $row['name'] . "</td>
             <td>" . $row['date'] . "</td>
             <td>" . $row['price'] . "</td>
             </tr>";
                }
                $result = null;
                ?>
            </tbody>
        </table>

        <?php

        $stmt = $conn->query("SELECT COUNT(*) AS cnt FROM `transaction` WHERE buyer_id = $user_id");
        $count = 0; //文章總量
        foreach ($stmt as $row) {
            $count = $row['cnt'];
        }

        $conn = null;
        ?>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>