<?php
session_start();
include 'index_navbar.php';
require_once 'mydatabase.php';
$per = 10; //每個頁面10筆資料
?>

<!doctype html>
<html lang="en">

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

        <div class="mt-5 mb-5 p-1"></div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="width:40%">標題</th>
                    <th scope="col" style="width:35%">發布日期</th>
                    <th scope="col">分類</th>
                </tr>
            </thead>
            <tbody>
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
                $sql = "SELECT title,insert_time,theme FROM article ORDER BY  insert_time DESC , id DESC LIMIT $page,$per";

                // 運行 SQL
                $query  = $conn->query($sql);
                $result = $query->fetchAll();

                foreach ($result as $row) {
                    echo '<tr><td>' . $row['title'] . '</td><td>' . $row['insert_time'] . '</td><td>' . $row['theme'] . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
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