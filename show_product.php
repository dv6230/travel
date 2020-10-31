<? 
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style3.css">
    <title>旅遊列表</title>
</head>

<body>
    <?php include 'index_navbar.php'; ?>
    <img src="img/show_product_1.jpg" alt="" class="head_img">
    <div class="container mb-5">
        <div class="p-5 m-2">
            <h1>旅遊列表</h1>
        </div>

        <?php
        require_once 'mydatabase.php';
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT id,title,content,image_name FROM attractions WHERE isshow = 1");
        $stmt->execute();
        $result_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php foreach ($result_list as $value) : ?>
            <div class="card_list row">
                <div class="describe-content col-md-6 m-0">
                    <h2><?php echo $value['title']; ?></h2>
                    <p><?php echo $value['content']; ?></p>                    
                    <button class="btn btn-outline-primary d-flex align-items-end" id='<?php echo 'tarvelid' . $value['id']; ?>'>1234</button>
                    <div class="clearfix"></div>
                </div>               
                <div class="col-md-6 m-0 p-0">
                    <img class="describe-image img-fluid" src="<?php echo 'product_image/' . $value['image_name']; ?>" alt="">
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <?php include 'index_footer.html'; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>