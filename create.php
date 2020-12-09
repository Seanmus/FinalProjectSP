<?php
    require 'loginProcess.php';
    require 'connect.php';

    $query = "SELECT * FROM consoles";
    $statement = $db->prepare($query);
    $statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <script src="create.js" type="text/javascript"></script>
</head>
<body>
    <form action = "searchResults.php" id = "form" method="POST">
      <label for="title">Search for a game by title</label>
      <input type="text" id = "title" name="title">
      <button type="submit">Submit search</button>
    </form>
    </br>

    <h1>Enter in the details of your game details.</h1>
    <form id = "game" action="createProcess.php" method="post">

        <label for="name">Name of Item</label>
        <input type="text" id = "name" name="name">
        <p id="nameError">* The name is required.</p>

        <label for="genre">Genre</label>
        <input type="text" id = "genre" name="genre">

        <label for ="platform"> Choose a Platform: </label>
        <select name="platform" id="platform">
        <?php while($row = $statement->fetch()): ?>
            <option value="<?=$row['console']?>"><?=$row['console']?></option>
        <?php endwhile ?>
        </select>

        <label for="condition">Condition</label>
        <input type="text" id = "gameCondition" name="gameCondition">
        
        <button type="submit">Submit Game</button>
    </form>
</body>
</html>