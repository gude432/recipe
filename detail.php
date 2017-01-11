<?php
require("config.php");
$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);
?>
<?php>
$recipe_id = $_GET['RecipeId'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<title><?php echo $config_sitename; ?></title>
</head>
<body>
	
		<div data-role="header">
			<h1>Recipe Details</h1>
				<div data-role="navbar">
					<ul>
						<li><a href="index.php">Recipe List</a></li>
						<li><a href="add_recipe_detail.php?RecipeID=<?php echo $recipe_id ?>">Add Ingredient</a></li>
						
					</ul>
				</div>
		</div>
		<?php>
						$sql = "SELECT * FROM Recipe WHERE Recipe.ID = ".$_GET['RecipeId']."" ; 
						$result = mysql_query($sql);					
						while($row = mysql_fetch_assoc($result)){						
							$title = $row['Title'];
							$descreption = $row['Descreption'];
							$imageurl = $row['PictureUrl'];
						}
					?>
		
		<div data-role="main" class="ui-content">
		
			<div id="navContent">
				<h1><?php echo $title ?></h1>
				<p><?php echo $descreption ?></p>
				<img src=<?php echo $imageurl ?> height="200" width="200">
				<h2>Ingredients</h2>
				
				<ul data-role="listview">
					<?php>
						$sql = 
						"SELECT *
						FROM RecipeDetail
						LEFT JOIN Ingredient ON (Ingredient.ID = RecipeDetail.IngredientID)
						WHERE (RecipeDetail.RecipeID = ".$_GET['RecipeId'].")" ; 
						$result = mysql_query($sql);					
						while($row = mysql_fetch_assoc($result)){						
							echo '<li>
							<h2>'. $row['Name'].'</h2><p>Quantity '. $row['Quantity'].' '. $row['Unit'].'</p>
							
							<div position=relative align=right data-role="controlgroup" data-type="horizontal">
										<a href="edit_recipe_detail.php?RecipeId='.$row['RecipeID'].'&IngredientId='.$row['IngredientID']. '" data-role="button">edit</a>
										<a href="edit_recipe_detail.php?Delete=1&RecipeId='.$row['RecipeID'].'&IngredientId='.$row['IngredientID']. '" data-role="button">delete</a>
										
										
									</div>
							
							
							</li>';									
						}
					?>
				</ul>
			</div>
		</div>
		<div data-position="fixed" data-role="footer">
			<p></p>
		</div>
	
	
</body>
</html>