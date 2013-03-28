<?php
require_once("classes/helper.php");
require_once("classes/db_setup.php");

$dbconnect = new DB_Class();

//$query = "select * from `contentlink` where createon >= '".date('Y-m-d').' 00:00:00'."' AND createon < '".date('Y-m-d').' 23:59:59'."' order by category asc";
$query = "select "
	."clink.articleTitle as text, clink.link as link, cat.category_name as category_name, clink.id as id, clink.notes as notes "
	."from `contentlink` as clink inner join categories as cat on clink.category = cat.id "
	."where updatedon >= '".date('Y-m-d',strtotime('-1 days')).' 00:00:00'."' AND updatedon < '".date('Y-m-d').' 23:59:59'
	."'and clink.category is not NULL order by cat.category_order asc";

//echo $query;

$results = $dbconnect->query($query);
$currCategory = "";
//echo "Link Count:".mysql_num_rows($results);
?>
<html>
<head>
<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'>
</head>
<body>
<?php
echo "<ul>";
while($row = mysql_fetch_array($results)){
	if($row["category_name"]!=$currCategory){
		echo "</ul>";
		echo "<strong>".$row["category_name"]."</strong>";
		echo "<ul>";
		$currCategory = $row["category_name"];
		echo "<li><a href='".$row["link"]."'>".$row["notes"]."</a></li>"; 
	}else{
		echo "<li><a href='".$row["link"]."'>".$row["notes"]."</a></li>"; 
	}
}

function fetchCategoryName($id){
	$dbconnect = new DB_Class();
	$query = "select * from categories where id =".$id;

	$row = $dbconnect->getone($query);
	return $row[1];
}
?>
</body>
</html>
