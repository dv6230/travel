<?php
//初始化檔案，用於建立新資料庫結構
require_once 'mydatabase.php';

$conn = new mysqli($servername, $username, $password);
$sql = 'CREATE DATABASE travel';
if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo $conn->error;
}
$conn->close();


$connection = new mysqli($servername, $username, $password, $dbname);

$str = '成功建立資料表';

function create_table($name, $query)
{
    querymysql("CREATE TABLE IF NOT EXISTS $name($query)");
}

function querymysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result) $str = '建立資料表失敗';
}



create_table('transaction', "`id` int(11) NOT NULL AUTO_INCREMENT,
`product_id` int(11) NOT NULL,
`price` int(11) NOT NULL,
`date` date NOT NULL DEFAULT current_timestamp(),
`ord_time` time NOT NULL DEFAULT current_timestamp(),
`buyer_id` int(11) NOT NULL,
PRIMARY KEY (`id`)");

create_table('user', "`id` int(11) NOT NULL AUTO_INCREMENT,
`account` varchar(20) NOT NULL,
`password` varchar(256) NOT NULL,
`auth` int(11) NOT NULL DEFAULT 0,
PRIMARY KEY (`id`),
KEY `account` (`account`),UNIQUE(`account`)");

create_table('article', " `id` INT NOT NULL AUTO_INCREMENT , 
`title` VARCHAR(125) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`content`  MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`theme` VARCHAR(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`insert_time` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)");

create_table('attractions', "   `id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
`content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
`price` int(11) NOT NULL DEFAULT 99999,
`image_name` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
`isshow` tinyint(1) NOT NULL DEFAULT 1,
`time` datetime NOT NULL DEFAULT current_timestamp(),
PRIMARY KEY (`id`)");

create_table('user_detail', " `id` int(11) NOT NULL,
`name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
`address` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
`email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
`gender` tinyint(1) NOT NULL,
`phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
`birthday` date NOT NULL,
PRIMARY KEY (`id`)");




//預設 管理者帳號密碼 
$result = $connection->query("INSERT IGNORE INTO `user` (`id`, `account`, `password`, `auth`) VALUES (NULL, 'root', 'root','2');");


echo $str;
