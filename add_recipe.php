<?php
require("config.php");
$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);
?>
<?php
	$title = $_POST['title'];
	$descreption = $_POST['descreption'];
	$time = $_POST['time'];
	$imageurl = $_POST['imageurl'];
	$serving = $_POST['serving'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $config_sitename; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="script.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<title><?php echo $config_sitename; ?></title>
</head>
<body>
		<div data-role="page" id="two">
		<div data-role="header">
			<h1>Add Recipe</h1>
			<div data-role="navbar">
				<ul>
					<li><a href="<?php echo $list_page; ?>">List</a></li>
				</ul>
			</div>
		</div>
		<div data-role="main" class="ui-content">
			<div id="navContent">
				<form name="myForm" onsubmit="return validateForm()"  method="post" action="add_recipe.php">
					<div class="ui-field-contain">
						<label for="title">Recipe:</label> <input type="text" name="title"	id="title"></input>
						<label for="textarea">Descreption:</label>
						<textarea cols="40" rows="8" name="descreption" id="descreption"></textarea>
						<label for="time">Time(min):</label> <input type="text" name="time" id="time"	></input>
						<label for="imageurl">Image URL:</label> <input type="text" name="imageurl" id="imageurl"></input>
						<label for="serving">Serving:</label> <input type="text" name="serving" id="serving"></input>
					</div>
					<input type="submit" value="Add"></input>
				</form>
<?php
if( isset($_POST['title']) ){
		$sql = "INSERT INTO `Recipe` (`Title`, `Descreption`, `DateAdded`, `PictureUrl`, `MinutesToPrepare`, `Serving`) VALUES
				('$title', '$descreption', now(), '$imageurl', '$time', '$serving');";
		$result = mysql_query($sql);	
	if (mysql_query($sql)) {
		echo "New record created successfully";
	} 
	else {
		echo "Error: " . $sql . "<br>" . mysql_error($db);
	}
}
mysql_close($db);
?>

			</div>
		</div>
		<div data-position="fixed" data-role="footer">
			<p></p>
		</div>
	</div>
	

</body>
</html>