<?php
require("config.php");
$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);
?>
<?php
	$title_updated = $_POST['title'];
	$descreption_updated = $_POST['descreption'];
	$time_updated = $_POST['time'];
	$imageurl_updated = $_POST['imageurl'];
	$serving_updated = $_POST['serving'];
	$recipe_id = $_GET['RecipeId'];
	$delete = $_GET['Delete'];
	$edit = $_GET['Edit'];
	
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
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="script.js"></script>
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
		<?php>
                                  $sql = "SELECT * FROM Recipe WHERE Recipe.ID = ".$recipe_id."" ; 
                                  $result = mysql_query($sql);                                    
                                  while($row = mysql_fetch_assoc($result)){                                               
                                          $title = $row['Title'];                                                                 
                                          $descreption = $row['Descreption'];                                                                 
                                          $time = $row['MinutesToPrepare'];                                                                 
                                          $imageurl = $row['PictureUrl'];                                                                 
                                          $serving = $row['Serving'];                                                                 
                                  }
                          ?>
			<div id="navContent">
				<form name="myForm" onsubmit="return validateForm()" method="post" action="edit_recipe.php?Edit=1&RecipeId=<?php echo $recipe_id ?>">
					<div class="ui-field-contain">
						<label for="title">Recipe:</label> <input type="text" name="title"	id="title" value="<?php echo $title ?>">	</input>
						<label for="textarea">Descreption:</label>
						<textarea cols="40" rows="8" name="descreption" id="descreption"><?php echo $descreption ?></textarea>
						<label for="time">Time(min):</label> <input type="text" name="time" id="time" value="<?php echo $time ?>"	></input>
						<label for="imageurl">Image URL:</label> <input type="text" name="imageurl" id="imageurl" value="<?php echo $imageurl ?>" ></input>
						<label for="serving">Serving:</label> <input type="text" name="serving" id="serving" value="<?php echo $serving ?>" ></input>
					</div>
					<input type="submit" value="Update"></input>
				</form>
<?php
if( isset($_GET['Delete']) ){
	if($delete == 1){
		$sql = "DELETE FROM `Recipe` WHERE `ID`= '$recipe_id' ";
		$result = mysql_query($sql);	
		echo "Deleted";
		header('Location: http://users.metropolia.fi/~gudetag/recipe/');
		
	}	
}

if( isset($_GET['Edit']) ){
	if( isset($_POST['title']) ){
			$sql = "UPDATE `Recipe` SET `ID`= '$recipe_id',`Title`='$title_updated',`Descreption`='$descreption_updated',`DateAdded`=now(),`PictureUrl`='$imageurl_updated',`MinutesToPrepare`='$time_updated',`Serving`='$serving_updated' WHERE `ID`= '$recipe_id'";
			echo $sql;
			$result = mysql_query($sql);	
		if (mysql_query($sql)) {
			echo "Updated successfully";
			header('Location: http://users.metropolia.fi/~gudetag/recipe/');
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysql_error($db);
		}
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