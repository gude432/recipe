
-- CREATE TABLE IF NOT EXISTS `Recipe` (
  -- `ID` int(11) NOT NULL,
  -- `Title` varchar(50) default NULL,
  -- `Descreption` varchar(400) default NULL,
  -- `DateAdded` datetime default NULL,
  -- `PictureUrl` varchar(100) default NULL,
  -- `MinutesToPrepare` int(11) default NULL,
  -- `Serving` int(11) default NULL
-- ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERT INTO `Recipe` (`ID`, `Title`, `Descreption`, `DateAdded`, `PictureUrl`, `MinutesToPrepare`, `Serving`) VALUES
-- (1, 'Cucumber and Buttermilk Soup', 'A cold tangy soup, refreshing and unique', now(), 'www.google.com', 30, 4);

-- CREATE TABLE IF NOT EXISTS `Ingredient` (
  -- `ID` int(11) NOT NULL,
  -- `IngredientName` varchar(50) 
  -- PRIMARY KEY ('ID');
-- ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSERT INTO `Ingredient` (`ID`, `Name`) VALUES
-- (1, 'cucumber'),(2, 'buttermilk'),(3, 'cream'),(4, 'tarragon'),(5, 'lemon juice'),(6, 'sugar'),(7, 'pepper'),(8, 'salt');

INSERT INTO `RecipeDetail` (`RecipeID`, `IngredientID`,`Unit`,`Quantity` ) VALUES
(1, 1, dl, 5);

INSERT INTO `RecipeDetail` (`RecipeID`, `IngredientID`,`Unit`,`Quantity` ) VALUES
(1, 2, cups, 6), (1, 2, cups, 6) , (1, 3, cups, 1) , (1, 2, tbs, 2) ;

SELECT *
FROM Recipe
JOIN IngredientDetail ON (Recipe.id = IngredientID)
JOIN Ingredients ON (RecipeDetail.IngredientID = Ingredient.ID)
