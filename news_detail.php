<?php
$novalue = '<h2>查無資料</h2>';
$strarray = array();
if (isset($_GET['article'])) {
    $article_id = $_GET['article'];
    require_once 'mydatabase.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * From article WHERE id = $article_id";
    $stmt = $conn->query($sql);

    foreach ($stmt as $value) {
        $strarray['id'] = $value['id'];
        $strarray['title'] = $value['title'];
        $strarray['content'] = $value['content'];
        $strarray['theme'] = $value['theme'];
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <title>Hello, world!</title>
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>

    <?php include 'index_navbar.php' ?>
    <div class="container p-0 ">
        <a href="#" onclick="goback()" class="mt-2 d-inline-block">返回</a>
        <div class="p-0 m-5"></div>
        <?php if (sizeof($strarray) > 0) : ?>
            <h1 class="m-2"><?php echo $strarray['title'] ?></h1 class="m-2">
            <h3><span class="badge mt-3 theme-style"><?php echo $strarray['theme'] ?></span></h3>
            <p class="mt-4"><?php echo $strarray['content'] ?></p>
        <?php else : ?>
            <?php echo $novalue; ?>
        <?php endif; ?>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var theme = $('.theme-style').text();
            if (theme == '焦點') {
                $('.theme-style').addClass('badge-warning');
            } else if (theme == '新聞') {
                $('.theme-style').addClass('badge-success');
            } else if (theme == '活動') {
                $('.theme-style').addClass('badge-primary');
            } else if (theme == '介紹') {
                $('.theme-style').addClass('badge-info');
            } else {
                $('.theme-style').addClass('badge-secondary');
            }
        });

        function goback() {
            window.history.back();
        }
    </script>
</body>

</html>