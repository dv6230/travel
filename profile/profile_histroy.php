<?php

require_once 'mydatabase.php';
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
    header("Location:login_page.php");
}
if (isset($_GET['page'])) {
    $page_num = $_GET['page'];
} else {
    $page_num = 1;
}
$per = 10; //每個頁面10筆資料
?>
<h3 class='mb-3'>歷史交易紀錄</h3>
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
        $page1 = ($page_num - 1) * 10; //從第1筆資料開始搜尋        
        $stmt = $conn->prepare("SELECT * FROM transaction WHERE buyers_id = $user_id  ORDER BY date DESC , id ASC LIMIT $page1,$per");
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

$stmt = $conn->query("SELECT COUNT(*) AS cnt FROM `transaction` WHERE buyers_id = $user_id");
$count = 0; //文章總量
foreach ($stmt as $row) {
    $count = $row['cnt'];
}
$pages = ceil($count / $per); //換算有幾頁, $per每頁幾筆資料
$conn = null;
?>


<nav aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-end d-block">
        <?php
        if ($pages > 0) {
            echo '<li class="page-item"><a class="page-link" href="login_profile.php?type=histroy&page=' . ($page_num - 1) . '">上一頁</a></li>';
        }
        ?>

        <?php
        $str = 'login_profile.php?type=histroy&page=';
        /* if ($pages > 5) {
            echo '<li class="page-item"><a class="page-link" href="' . $str .'1">1</a></li>';
            for ($i = $page_num+1; $i < $pages; $i++) {
                echo '<li class="page-item"><a class="page-link" href="' . $str . $i . '">' . $i . '</a></li>';
            }
            echo '<li class="page-item"><a class="page-link" href="#">...</a></li>';
            //顯示最末頁
            echo '<li class="page-item"><a class="page-link" href="' . $str . $pages . '">' . $pages . '</a></li>';
        */
            //} else {
            for ($i = 1; $i <= $pages; $i++) {
                echo '<li class="page-item"><a class="page-link" href="' . $str . $i . '">' . $i . '</a></li>';
            }
        //}
        ?>

        <?php
        if ($pages > 0) {
            echo '<li class="page-item"><a class="page-link" href="login_profile.php?type=histroy&page=' . ($page_num + 1) . '">下一頁</a></li>';
        }
        ?>

    </ul>
    <?php if ($pages <= 0) {
        echo '<h3 class="d-flex justify-content-center">查無資料</h3>';
    } ?>
</nav>