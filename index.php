<!doctype html>
<html lang="zh-Hant">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style1.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>悠活森林</title>
</head>

<body>
    <?php
    session_start();
    include 'index_navbar.php'; ?>
    <?php include 'index_content.html'; ?>
    <?php include 'index_footer.html'; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    
    
    <script>
        $(document).ready(function() {
            $("button").click(function(e) {
                /*
                $.ajax({
                    url: "tools/index_ajax.php?show="+$(this).val(),
                    success: function(result) {
                        $("#show").html(result);
                    }
                });
                */
                var str = $(this).val() ;
                var xhr = new XMLHttpRequest();
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        responseobject = JSON.parse(xhr.responseText);  
                        var getcontent = responseobject["display"].find(ary => ary.title === str )['content']                 
                        var content_str = '<p class="bg-glass d-flex align-items-center p-5">'+ getcontent +'</p>' ;
                        $("#show").html(content_str);
                        $("#show").removeClass("d-none");
                        var img_name = responseobject["display"].find(ary => ary.title === str )['image'];
                        var htmlstr = '<img src="img/'+ img_name +'" alt="">';
                        $("#show_img").html(htmlstr);
                    }
                }
                xhr.open('GET', 'tools/show.json', true);
                xhr.send(null);
            });
        });
    </script>
</body>

</html>