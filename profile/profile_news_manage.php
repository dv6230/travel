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
$per = 10; //每個頁面10筆資料
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style1.css">
    <title>消息管理</title>
    <style>
        .edit-hover:hover {
            color: white;
        }
    </style>
</head>

<body>
    <?php include '../index_navbar.php'; ?>

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="http://localhost/travel/login_profile.php?type=center">會員中心</a></li>
                <li class="breadcrumb-item"><a href="http://localhost/travel/login_profile.php?type=else">其他</a></li>
                <li class="breadcrumb-item active" aria-current="page">消息管理</li>
            </ol>
        </nav>

        <h2 class="m-4">消息管理</h2>
        <div class="mt-3 mb-3 p-1"></div>

        <table class="table">
            <thead>
                <tr class="bg-primary text-light">
                    <th scope="col" style="width:15%">編號</th>
                    <th scope="col" style="width:35%">標題</th>
                    <th scope="col" style="width:35%">發布日期</th>
                    <th scope="col">分類</th>
                    <th scope="col">編輯</th>
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
                $sql = "SELECT * FROM article ORDER BY  insert_time DESC , id DESC LIMIT $page,$per";

                // 運行 SQL
                $query  = $conn->query($sql);
                $result = $query->fetchAll();

                foreach ($result as $row) {
                    $str = '<form action="profile_news_edit.php" method="POST">
                    <input type="text" name="article_id" value="';

                    $str2 = '" hidden>
                    <button type="submit" class="btn btn-outline-dark text-dark p-0" >
                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-filter-left edit-hover " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </button>
                </form>'; //編輯 button
                    echo '<tr><td>' . $row['id'] . '</td><td>' . $row['title'] . '</td><td>' . $row['insert_time'] . '</td> <td>' . $row['theme'] . '</td> <td>' . $str . $row['id'] . $str2 . '</td> </tr>';
                }
                ?>
            </tbody>
        </table>

        <?php
        require_once '../tools/count_page_tool.php';
        $obj_page = new count_page();
        $table_name = 'article';
        $num_of_page = $obj_page->pagecount($table_name, $per); //取得分頁總數
        ?>

        <nav aria-label="Page navigation example">
            <ul class="pagination d-flex justify-content-end d-block">

                <?php
                if ($num_of_page > 0) {
                    if (($getpage - 1) > 0) {
                        echo '<li class="page-item"><a class="page-link" href="profile_news_manage.php?page=' . ($getpage - 1) . '">上一頁</a></li>';
                    }
                }
                ?>

                <?php
                $str = 'profile_news_manage.php?page=';
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
                        echo '<li class="page-item"><a class="page-link" href="profile_news_manage.php?page=' . ($getpage + 1) . '">下一頁</a></li>';
                    }
                }
                ?>

            </ul>
        </nav>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>