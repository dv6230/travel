<?php
session_start();
include 'index_navbar.php';
require_once 'mydatabase.php';
$per = 10; //每個頁面10筆資料
?>

<?php

if (isset($_GET['page'])) {
    $getpage = $_GET['page'];
} else {
    $getpage = 1;
}


$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$page = ($getpage - 1) * 10; //從第1筆資料開始搜尋  
$sql = "SELECT id,title,insert_time,theme FROM article ORDER BY  insert_time DESC , id DESC LIMIT $page,$per";

// 運行 SQL
$query  = $conn->query($sql);
$result = $query->fetchAll();
?>

<!doctype html>
<html lang="zh-Hant">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style1.css">
    <title>最新消息</title>
</head>

<body>
    <div class="container">

        <div class="mt-3 p-1 ">
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <ul class="m-0 p-0">
                    <li class="w-s1 d-inline-block font-weight-bold">標題</li>
                    <li class="w-s2 d-inline-block font-weight-bold">發布日期</li>
                    <li class="w-s3 d-inline-block font-weight-bold">分類</li>
                </ul>
            </li>

            <?php foreach ($result as $row) : ?>
                <li class="list-group-item">
                    <ul class="m-0 p-0">
                        <li class="w-s1 d-inline-block font-weight-bold"><a href="news_detail.php?article=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a></li>
                        <li class="w-s2 d-inline-block font-weight-bold"><?php echo $row['insert_time'] ?></li>
                        <li class="w-s3 d-inline-block font-weight-bold"><?php echo $row['theme'] ?></li>
                    </ul>
                </li>
            <?php endforeach; ?>


        </ul>

        <?php
        require_once 'tools/count_page_tool.php';
        $obj_page = new count_page();
        $table_name = 'article';
        $num_of_page = $obj_page->pagecount($table_name, $per); //取得分頁總數
        ?>

        <nav aria-label="Page navigation example">
            <ul class="pagination d-flex justify-content-end d-block">

                <?php
                if ($num_of_page > 0) {
                    if (($getpage - 1) > 0) {
                        echo '<li class="page-item"><a class="page-link" href="news.php?page=' . ($getpage - 1) . '">上一頁</a></li>';
                    }
                }
                ?>

                <?php
                $str = 'news.php?page=';
                for ($i = 1; $i <= $num_of_page; $i++) {
                    if ($i == $getpage) {
                        echo '<li class="page-item active"><a class="page-link" href="' . $str . $i . '">' . $i . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="' . $str . $i . '">' . $i . '</a></li>';
                    }
                }
                ?>

                <?php
                if ($num_of_page > 0) {
                    if (($getpage + 1) <= $num_of_page) {
                        echo '<li class="page-item"><a class="page-link" href="news.php?page=' . ($getpage + 1) . '">下一頁</a></li>';
                    }
                }
                ?>

            </ul>
        </nav>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>