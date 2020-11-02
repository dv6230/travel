<?php

session_start();

//身分驗證
require '../tools/identify.php';
$identity = new identify();

//預設資料
$hasdata = false;

//更改資料
if (isset($_POST['title'])  && isset($_POST['id']) && isset($_POST['content'])  && isset($_POST['price'])) {

    $isshow = false;
    isset($_POST['isshow']) ? $isshow = true : $isshow = false;

    require '../tools/manager_product_upload.php';
    $update = new product_update();
    $update->update($_POST['title'], $_POST['content'], $_POST['price'], $isshow, $_POST['id']);
    header('Location:profile_product_manage.php');    
}

//查詢資料
if (isset($_GET['tid'])) {
    $tid = $_GET['tid'];
    require '../mydatabase.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM attractions WHERE id = ?");
    $stmt->execute(array($tid));
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    $strarray = array();
    if ($count) {
        foreach ($stmt as $value) {
            $strarray['id'] = $value['id'];
            $strarray['title'] = $value['title'];
            $strarray['content'] = $value['content'];
            $strarray['price'] = $value['price'];
            $strarray['image_name']  = $value['image_name'];
            $strarray['isshow'] = $value['isshow'];
            $strarray['time']  = $value['time'];
        }
        $hasdata = true;
    } else {
        $hasdata = false;
    }
}
//header("Location:profile_center.php");


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>旅遊編輯</title>
    <style>
        nav.navbar {
            background-color: rgba(10, 10, 10, 0.9);
        }

        label {
            font-size: 20px;
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
                <li class="breadcrumb-item"><a href="http://localhost/travel/profile/profile_product_manage.php">旅遊管理</a></li>
                <li class="breadcrumb-item active" aria-current="page">編輯</li>
            </ol>
        </nav>
        <?php if ($hasdata == true) : ?>

            <form action="profile_product_edit.php" method="POST">
                <input type="text" class="form-control" value="<?php echo $strarray['id']; ?>" hidden name="id">
                <div class="form-group">
                    <label for="title">標題</label>
                    <input type="text" class="form-control" value="<?php echo $strarray['title']; ?>" id="title" aria-describedby="標題" name="title" required>
                </div>

                <div class="form-group">
                    <label for="" class="d-block">圖片展示</label>
                    <br>
                    <div class="d-flex justify-content-center">
                        <img src="../product_image/<?php echo $strarray['image_name'] ?>" class="" height="360px" alt="Responsive image">
                    </div>

                </div>

                <div class="form-group">
                    <label for="a_content">內容描述</label>
                    <textarea class="form-control" id="a_content" rows="10" name="content" required><?php echo  $strarray['content'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="price">價錢</label>
                    <input type="number" class="form-control" value="<?php echo  $strarray['price'] ?>" id="price" aria-describedby="價錢" name="price" required>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="isshow" id="exampleCheck1" value="1" <?php if ($strarray['isshow'] == true) echo 'checked'; ?>>
                    <label class="form-check-label" for="exampleCheck1">是否展示</label>
                </div>



                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php endif; ?>


    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>