<?php
require("config.php");
$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $config_sitename; ?></title>
</head>
<body>
	<div data-role="page" id="one">
		<div data-role="header">
			<h1>Find Recipe</h1>
		</div>
		<div data-role="header">
			<div data-role="navbar">
				<ul>
					<li><a href="add_recipe.php">Add Recipe</a></li>
					
				</ul>
			</div>
		</div>
		<div data-role="main" class="ui-content">
			<div id="navContent">
								
				<h2 class="title">Choose a recipe</h2>
					<ul data-role="listview">
						<?php>
							$sql = "SELECT * FROM Recipe" ; //checks if the user name exists
							$result = mysql_query($sql);					
							while($row = mysql_fetch_assoc($result)){						
								echo '<li>
									<a href="detail.php?RecipeId='.$row['ID']. '"><img src="'.$row['PictureUrl'].'" alt="image" /><h2>'. $row['Title'].'</h2></a>
									<div position=relative align=right data-role="controlgroup" data-type="horizontal">
										<a href="edit_recipe.php?RecipeId='.$row['ID']. '" data-role="button">edit</a>
										<a href="edit_recipe.php?Delete=1&RecipeId='.$row['ID']. '" data-role="button">delete</a>
										
										
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
	</div>
	<!-- Include meta tag to ensure proper rendering and touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Include the jQuery library -->
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"
		type="text/javascript"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"
		type="text/javascript"></script>
	<script src="script.js" type="text/javascript"></script>
	<!-- Include jQuery Mobile stylesheets -->
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<link rel="stylesheet" href="custom.css">
	<!-- Include the jQuery Mobile library -->
	<script
		src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"
		type="text/javascript"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans|VT323'
		rel='stylesheet' type='text/css'>
</body>
</html>
	