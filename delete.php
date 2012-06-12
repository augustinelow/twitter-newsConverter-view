<?php
require_once("classes/db_setup.php");

$id = $_REQUEST["id"];

$dbconnect = new DB_Class();

$query = "delete from `contentlink` where id=$id";
$dbconnect->query($query);

$nextid = $id -1;

header("Location: view.php?id=".$nextid) ;
?>