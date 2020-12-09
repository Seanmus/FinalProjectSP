<?php
    require 'connect.php';

    $name = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = "%".$name."%";


    $console = filter_input(INPUT_POST, 'console', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!empty($console)){
      $query = "SELECT * FROM games WHERE UPPER(name) LIKE UPPER(:name) AND platform = :platform";
      $statement = $db->prepare($query);
      $statement->bindValue(':name', $name);
      $statement->bindValue(':platform', $console);
      $statement->execute();
  
      $query = "SELECT * FROM consoles";
      $statementCategories = $db->prepare($query);
      $statementCategories->execute();
    }
    else{
      $query = "SELECT * FROM games WHERE UPPER(name) LIKE UPPER(:name)";
      $statement = $db->prepare($query);
      $statement->bindValue(':name', $name);
      $statement->execute();
  
      $query = "SELECT * FROM consoles";
      $statementCategories = $db->prepare($query);
      $statementCategories->execute();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php if($statement->rowCount() >= 1): ?>
    <h1>Your search results are:</h1>
    <?php while($row = $statement->fetch()): ?>
    <div class="game_post">
      <h2><a href="show.php?id=<?=$row['id'] ?>"><?=$row['name']?></a></h2>
      <form id = "game" action="searchResults.php" method="post">

      <label for ="console"> Choose a Platform: </label>
      <select name="console" id="platform">
        <option value="">No Console</option>
      <?php while($rowCategory = $statementCategories->fetch()): ?>
        <option value="<?=$rowCategory['console']?>"><?=$rowCategory['console']?></option>
      <?php endwhile ?>
      </select>

      <input type="hidden" name="title" value="<?=$name?>" />

      <button type="submit">Submit Search</button>
</form>
    </div>
    <?php endwhile ?>
<?php else: ?>
  <p>No rows found for <?=$name?></p>
<?php endif ?>

</body>
</html>