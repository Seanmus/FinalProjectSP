<!-------w--------

    Assignment 4
    Name: Sean Piche
    Date:Nov 16th 2020
    Description: Allows the user to input data and updates an existing record to the database.

----------------->

<?php
    require 'loginProcess.php';
    require 'connect.php';
    if(!filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)){
        header('Location: index.php');
        exit();
    }
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $query = "SELECT * FROM games WHERE id = {$id}";
    $statement = $db->prepare($query);
    $statement->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Stung Eye - Edit Post Wootly Grins</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <form action = "searchResults.php" id = "form" method="POST">
      <label for="title">Search for a game by title</label>
      <input type="text" id = "title" name="title">
      <button type="submit">Submit search</button>
    </form>
    </br>
    
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Edit Post</a></h1>
        </div> <!-- END div id="header" -->
<ul id="menu">
    <li><a href="index.php" >Home</a></li>
    <li><a href="create.php" >New Post</a></li>
</ul> <!-- END div id="menu" -->
<div id="all_blogs">
  <form action="createProcess.php" method="post">
    <fieldset>
      <legend>Edit Game Data</legend>
        <?php while($row = $statement->fetch()): ?>
            <p>
                <label for="name"><?=$row['name']?></label>
                <input name="name" id="name" value="<?=$row['name']?>" />
            </p>
            <p>
                <label for="genre">Genre</label>
                <textarea name="genre" id="genre"><?=$row['genre']?></textarea>

                <label for="platform">Platform</label>
                <textarea name="platform" id="platform"><?=$row['platform']?></textarea>

                <label for="condition">Condition</label>
                <textarea name="gameCondition" id="gameCondition"><?=$row['gameCondition']?></textarea>
            </p>
            <p>
                <input type="hidden" name="id" value="<?=$row['id']?>" />
                <input type="submit" name="command" value="Update" />
                <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
            </p>
        <?php endwhile ?>
    </fieldset>
  </form>
</div>
        <div id="footer">
            Copywrong 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>