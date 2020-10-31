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
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <title>旅遊管理</title>
    <link rel="stylesheet" href="../css/style4.css">
</head>

<body>
    <?php include '../index_navbar.php'; ?>

    <div class="container-fluid">
        <div class="row mt-5 ">
            <div class="col-md-3 pl-5 ml-2">
                <div class="box1 p-2">
                    <a href="profile_add_product.php" class="">新增資料</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">

                    <?php
                    require_once '../mydatabase.php';
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("SELECT id,title,image_name,isshow FROM attractions ORDER BY id DESC");
                    $stmt->execute();
                    $result_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <?php foreach ($result_list as $value) : ?>
                        <div class="col-md-4 p-2 ">
                            <div class="card p-0">
                                <img src="../product_image/<?php echo $value['image_name']; ?>" height="275px" class="card-img-top w-100 " alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $value['title']; ?></h5>
                                    <!-- Rounded switch -->
                                    <label for="<?php echo 'show_' . $value['id']; ?>" class="label-hight">是否展售</label>
                                    <?php if ($value['isshow'] == 1) : ?>
                                        <label class="switch">
                                            <input type="checkbox" class="checkshow" id="<?php echo 'show_' . $value['id']; ?>" value="<?php echo $value['id']; ?>" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    <?php else : ?>
                                        <label class="switch">
                                            <input type="checkbox" class="checkshow" id="<?php echo 'show_' . $value['id']; ?>" value="<?php echo $value['id']; ?>">
                                            <span class="slider round"></span>
                                        </label>
                                    <?php endif; ?>
                                    <br>
                                    <a href="#" class="btn btn-primary">編輯</a>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $(".checkshow").click(function() {
                if ($(this).is(":checked")) {
                    //Jquery post
                    $.post(
                        "http://<?php echo $_SERVER['SERVER_NAME'] ?>/travel/tools/product_update.php", {
                            isshow: 1,
                            product_id: $(this).val()
                        },
                        function() {

                        }
                    );
                } else {
                    console.log('關閉');
                    $.ajax({
                        //Jquery ajax
                        url: "http://<?php echo $_SERVER['SERVER_NAME'] ?>/travel/tools/product_update.php",
                        data: {
                            isshow: 0,
                            product_id: $(this).val()
                        },
                        method: 'POST'
                    })
                }
            });
        });
    </script>
    <!-- Optional JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>