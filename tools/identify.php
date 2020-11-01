<?php

class identify
{
    function __construct()
    {
        if (!isset($_SESSION['user_id'])) header("Location:http://localhost/travel/login_page.php");
        $user_id = $_SESSION['user_id'];
        //權限大於0可以操作
        if (isset($_SESSION['auth'])) {
            $auth = (int)$_SESSION['auth'];
        }
        if (!($auth > 0)) {
            header("Location:profile_center.php");
        }
    }
}
