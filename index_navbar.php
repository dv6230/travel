<nav class="navbar navbar-expand-lg navbar-dark ">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/travel/index.php">
            <img src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/travel/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            Forest</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link text-light" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/travel/index.php">首頁<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">產品介紹</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/travel/news.php">最新消息</a>
                </li>
                <?php

                $str_is_out = '<li class="nav-item">                    
                            <a class="nav-link text-light" href="login_page.php">會員登入</a>
                            </li>';
                $str_is_in = '<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                會員中心
              </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/travel/login_profile.php">會員中心</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/travel/logout.php">登出</a>
                                </div>
                            </li>';
                if (isset($_SESSION['id'])) {
                    echo $str_is_in;
                } else {
                    echo $str_is_out;
                }
                ?>

            </ul>
        </div>
    </div>
</nav>