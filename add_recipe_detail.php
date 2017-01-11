<?php
require ("config.php");
$db = mysql_connect ( $dbhost, $dbuser, $dbpassword );
mysql_select_db ( $dbdatabase, $db );
?><?php
$name = $_POST ['name'];
$quantity = $_POST ['quantity'];
$unit = $_POST ['unit'];
$recipe_id = $_GET['RecipeID'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="generator"
    content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
      <?php echo $config_sitename; ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="script.js"></script>
    <title>
      <?php echo $config_sitename; ?>
    </title>
  </head>
  <body>
    <div data-role="page" id="two">
      <div data-role="header">
        <h1>Add Ingredients</h1>
        <div data-role="navbar">
          <ul>
            <li><a href="<?php echo $ingredient_list_page.'?RecipeId='.$recipe_id; ?>">Ingredient List</a></li>
          </ul>
        </div>
      </div>
      <div data-role="main" class="ui-content">
        <div id="navContent">
          <?php>
				  $sql = "SELECT * FROM Recipe WHERE Recipe.ID = ".$recipe_id."" ; 
				  $result = mysql_query($sql);                                    
				  while($row = mysql_fetch_assoc($result)){                                               
						  $title = $row['Title'];                                                                 
				  }
		  ?>
          <h1>Add details for <?php echo $title; ?></h1>
          <datalist id="ingredient">
            <?php>                                                  
			 $sql = "SELECT * FROM Ingredient" ; 
			 $result = mysql_query($sql);                                                   
			 while($row = mysql_fetch_assoc($result)){
			 echo '<option value="'.$row['Name'].'">'.$row['Name'].'';
			 }
			?>
          </datalist>
          <form name="myForm" onsubmit="return validateForm()" method="post" action="add_recipe_detail.php?RecipeID=<?php echo $recipe_id ?>">
            <div class="ui-field-contain">
            <label for="name">Ingredient:</label> 
            <input list="ingredient" type="text" name="name" id="name" /> 
            <label for="quantity">Quantity:</label> 
            <input type="text" name="quantity" id="quantity" /> 
            <label for="unit">Unit</label> 
            <input type="text" name="unit" id="unit" /></div>
            <input type="submit" value="Add" />
          </form><?php
                                      if (isset ( $_POST ['name'] )) {
                                          //check if already exists
                                          // echo $name + " added";                                     
                                          $result1 =mysql_query("SELECT * FROM Ingredient WHERE `Name` = '$name'");
										  // var_dump (mysql_fetch_assoc($result1));
                                          if ($result1 && mysql_num_rows($result1) > 0)

                                                  {
                                                          
                                                          while($row1 = mysql_fetch_assoc($result1)){
                                                          $ingredient_id = $row1['ID'];
														  // echo $ingredient_id;
														  }
                                                          
                                                  }
                                          else
                                                  {
                                                          // echo 'do not exist';
                                                          
                                                          $sql = "INSERT INTO `Ingredient` (`Name`) VALUES  ('$name');";
                                                          $result = mysql_query ( $sql );
                                                          $ingredient_id = mysql_insert_id();
                                                          
                                                          // echo "$name added";
                                                          
                                                          
                                                  }
                                                  
                                                  $sql2 = "INSERT INTO `RecipeDetail` (`RecipeID`,`IngredientID`,`Unit`, `Quantity` ) VALUES  ('$recipe_id', $ingredient_id, '$unit', '$quantity' );";
                                                  $result = mysql_query ( $sql2 );
                                                  
                                                  
										}
                                    mysql_close ( $db );
                                    ?>
        </div>
      </div>
      <div data-position="fixed" data-role="footer"></div>
    </div>
  </body>
</html>
