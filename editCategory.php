<?php
    require 'adminAuthentication.php';
    require 'connect.php';
 
    $console = filter_input(INPUT_GET, 'console', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM consoles WHERE console = '{$console}'";
    $statement = $db->prepare($query);
    $statement->execute();

    
    $query = "SELECT * FROM consoles";
    $statementCategories = $db->prepare($query);
    $statementCategories->execute();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Show</title>
</head>
<body>
<h1><a href="index.php">Home</a></h1>
<form method="post">
<?php while($row = $statementCategories->fetch()): ?>
    <a href="editCategory.php?console=<?=$row['console']?>"><?=$row['console']?></a>
    <br>
<?php endwhile ?>
</form>

<form action="categoriesProcess.php" method="post">
    <fieldset>
        <?php while($row = $statement->fetch()): ?>
            <legend>Edit Category <?=$row['console']?></legend>
            <p>
                <label for="console">Console</label>
                <input name="console" id="console" value="<?=$row['console']?>" />
            </p>
            <p>
                <input type="hidden" name="id" value="<?=$row['id']?>" />
                <input type="submit" name="command" value="Update" />
            </p>
        <?php endwhile ?>
    </fieldset>
  </form>
    <div id="footer">
        Copywrong 2020 - No Rights Reserved
    </div> 
</body>
</html>