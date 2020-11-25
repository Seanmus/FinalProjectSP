<?php
    require 'connect.php';

    $name = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = "%".$name."%";


    $query = "SELECT * FROM games WHERE UPPER(name) LIKE UPPER(:name)";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();

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
    </div>
    <?php endwhile ?>
<?php else: ?>
  <p>No rows found for <?=$name?></p>
<?php endif ?>

</body>
</html>