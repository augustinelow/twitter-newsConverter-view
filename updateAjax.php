<?php
require_once("classes/db_setup.php");

$keys = array_keys($_REQUEST);
$query_update_vars = "";
foreach($keys as $key){
	if($key!="id"){
		if($key!="category"){
			$query_update_vars .="`".$key."`='".mysql_escape_string($_REQUEST[$key])."',";		
		}else{
			$query_update_vars .="`".$key."`=".mysql_escape_string($_REQUEST[$key]).",";		
		}
	}	
}
$query_update_vars = substr($query_update_vars,0,strlen($query_update_vars)-1);

$query = "update `contentlink` set ".$query_update_vars." where `id`=".$_REQUEST["id"];
$dbconnect = new DB_Class();
$dbconnect->query($query);
?>