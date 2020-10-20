<?php
class count_page
{
  protected $servername = "localhost";
  protected $username = "root";
  protected $password = "";
  protected $dbname = "travel";

  function pagecount($table_name, $per)
  {

    $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username,$this->password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->query("SELECT COUNT(*) AS cnt FROM `$table_name` ");
    $count = 0;
    foreach ($stmt as $row) {
      $count = $row['cnt'];
    }
    $page = ceil($count / $per);
    $conn = null;
    return $page;
  }
}
