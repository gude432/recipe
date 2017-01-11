<?php
require("config.php");
$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);
?>
<?php
	$quantity_updated = $_POST['quantity'];
	$unit_updated = $_POST['unit'];
	$name_updated = $_POST['name'];
	$recipe_id = $_GET['RecipeId'];
	$ingredient_id = $_GET['IngredientId'];
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
			<h1>Edit Recipe</h1>
			<div data-role="navbar">
				<ul>
					<li><a href="<?php echo $ingredient_list_page.'?RecipeId='.$recipe_id; ?>">List</a></li>
				
				</ul>
			</div>
		</div>
		<div data-role="main" class="ui-content">
		<?php>
                         
						$sql = "SELECT * FROM RecipeDetail LEFT JOIN Ingredient ON (Ingredient.ID = RecipeDetail.IngredientID)
								WHERE RecipeID = '$recipe_id' AND IngredientID = '$ingredient_id'"  ; 
                                  $result = mysql_query($sql);  
									                          
                                  while($row = mysql_fetch_assoc($result)){						                                               
                                          $ingredient = $row['Name'];                                                                 
                                          $quantity = $row['Quantity'];                                                                 
                                          $unit = $row['Unit'];
										  
                                                                                                     
                                  }
                          ?>
			<div id="navContent">
			
			<datalist id="ingredient">
            <?php>                                                  
                                             $sql = "SELECT * FROM Ingredient" ; 
                                             $result = mysql_query($sql);                                                   
                                             while($row = mysql_fetch_assoc($result)){
                                             echo '<option value="'.$row['Name'].'">'.$row['Name'].'';
                                             }
                                            ?>
          </datalist>
			
				 <form name="myForm" onsubmit="return validateForm()" method="post" action="edit_recipe_detail.php?Edit=1&RecipeId=<?php echo $recipe_id; ?>&IngredientId=<?php echo $ingredient_id ;?>">
					<div class="ui-field-contain">
					<label for="name">Ingredient:</label> 
					<input list="ingredient" type="text" name="name" id="name" value="<?php echo $ingredient ?>"/> 
					<label for="quantity">Quantity:</label> 
					<input type="text" name="quantity" id="quantity" value = "<?php echo $quantity ?>"/> 
					<label for="unit">Unit</label> 
					<input type="text" name="unit" id="unit" value = "<?php echo $unit ?>"/></div>
					<input type="submit" value="Update" />
				</form>
				
<?php
if( isset($_GET['Delete']) ){
	if($delete == 1){
		$sql = "DELETE FROM `RecipeDetail` WHERE `RecipeID`= '$recipe_id' and `IngredientID`= '$ingredient_id' ";
		$result = mysql_query($sql);	
		echo "Deleted";
		header('Location: http://users.metropolia.fi/~gudetag/recipe/detail.php?RecipeId='.$recipe_id.'');		
	}	
}


if( isset($_GET['Edit']) ){
	if( $edit == 1 ){
			$sql = "UPDATE `Ingredient` SET `ID`= '$ingredient_id',`Name`='$name_updated' WHERE `ID`= '$ingredient_id'";
			echo $sql;
			$result = mysql_query($sql);
			mysql_query($sql);
			
			$sql2 = "UPDATE `RecipeDetail` SET `RecipeID`= '$recipe_id',`IngredientID`='$ingredient_id', `Unit`= '$unit_updated',`Quantity`='$quantity_updated' WHERE `IngredientID`= '$ingredient_id'";
			echo $sql2;
			$result2 = mysql_query($sql2);
			mysql_query($sql2);
			
			
		if (mysql_query($sql) and mysql_query($sql2)) {
			echo "Updated successfully";	
			header('Location: http://users.metropolia.fi/~gudetag/recipe/detail.php?RecipeId='.$recipe_id.'');
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