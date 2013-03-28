<?php
require_once("classes/helper.php");
require_once("classes/db_setup.php");

$dbconnect = new DB_Class();

//check req
$query = "select * from contentlink where category is NULL order by id desc";
if(isset($_REQUEST["id"])){
	$query = "select * from contentlink where id =".$_REQUEST["id"]." order by id desc";
}

$row = $dbconnect->getone($query);
$currentid = $row[0];

?>
<html>
<head>
<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/main.js"></script>
</head>
<body>
<div>
<br/>
<br/>
<ul class='categoryButtons'>
<?php
//get and display the categories
	$getCategoryQuery = "select * from categories order by category_order asc";
	$results = $dbconnect->query($getCategoryQuery);
	while($categoryRow = mysql_fetch_array($results)){
		//echo "<li><a class='red gradient catbtn' href='updateCategory.php?catid=".$categoryRow["id"]."&id=".$currentid."'>".$categoryRow["category_name"]."</a></li>";
		echo "<li><a data-catid='".$categoryRow["id"]."' class='".getCategoryColor($categoryRow["Type"])." gradient catbtn' href='#'>".$categoryRow["category_name"]."</a></li>";
	}
	//echo "<li><a class='blue gradient catbtn' href='delete.php?id=".$currentid."'>Delete This!</a></li>";
	echo "<li><a class='gradient catbtn' href='delete.php?id=".$currentid."'>X</a></li>";
?>
</ul>
</div>
<table>
<tr>
<td>
<?php
	echo "<div>";
	echo "ID: <strong id='id'>".$row[0]."</strong>";
	echo "<div><b>Tweet Title</b>: ".$row[1]."</div>";
	echo "<div><b>Date </b>: ".$row[9]."</div>";
?>
	<div>
		<b>Article Title: </b><br/>
			<input id="articleTitle" class="textField" name="inputfield" type="text" value="<?php echo $row[2];?>" />
	</div>
<?php
	echo "<div><b>Short Link: </b>".$row[3]."</div>";
?>
	<div>
		<b>Long Link: </b><br/>
		<a href='<?php echo $row[4];?>'><?php echo $row[4];?></a><br/>
			<input id="link" class="textField" name="inputfield" type="text" value="<?php echo stripUTM($row[4]);?>" />
	</div>
	<div>
		<b>Notes: </b><br/>
<?php
	$note_value = $row[7];
	if($note_value==""){
		$note_value=$row[2];
		echo "<div style='background-color:red;'>new</div>";
	}
?>
			<input id="notes" class="textField" name="inputfield" type="text" value="<?php echo $note_value;?>" />
	</div>

<?php
	echo "<div>".$row[6]."</div>";		
	echo "</div>";

?>
</td>
</tr>
</table>

</body>
</html>

