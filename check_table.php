<?php
//初始化檔案，用於建立新資料庫結構
require_once 'mydatabase.php';

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
`name` varchar(56) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
`price` int(11) NOT NULL,
`date` date NOT NULL DEFAULT current_timestamp(),
`buyers_id` int(11) NOT NULL,
PRIMARY KEY (`id`)");

create_table('user', "`id` int(11) NOT NULL AUTO_INCREMENT,
`account` varchar(20) NOT NULL,
`password` varchar(256) NOT NULL,
`name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
`auth` int(11) NOT NULL DEFAULT 0,
PRIMARY KEY (`id`),
KEY `account` (`account`)");

create_table('article', " `id` INT NOT NULL AUTO_INCREMENT , 
`title` VARCHAR(125) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`content`  MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`theme` VARCHAR(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`insert_time` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)");

//預設 管理者帳號密碼 
$result = $connection->query("INSERT INTO `user` (`id`, `account`, `password`, `name`, `auth`) VALUES (NULL, 'root', 'root', '管理者', '2');");

echo $str;
