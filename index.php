<?php
    session_start();
    require 'connect.php';

    $sort = filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM games ORDER BY $sort";
    $statement = $db->prepare($query);
    $statement->execute();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
  
    <form action = "searchResults.php" id = "form" method="POST">
      <label for="title">Search for a game by title</label>
      <input type="text" id = "title" name="title">
      <button type="submit">Submit search</button>
    </form>

    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
        <h2>You have administrative access<h2>
        <h1> <a href = "editAccount.php">Manage Accounts (Admins only!)</a></h1>
    <?php endif ?>

    <?php if (isset($_SESSION['username'])): ?>
        <h2>Welcome <?=$_SESSION['username']?><h2>
        <h2> <a href = "profilePhoto.php">Upload a Profile Photo</a></h2>
        </br>
        <h1> <a href = "logout.php">Logout</a></h1>
        <h1><a href ="create.php">Enter a record</a></h1>
        <h1>Sort by<h1>
        <h2><a href ="index.php?sort=name">Name A-Z</a></h2>
        <h2><a href ="index.php?sort=dateCreated">Date Created</a></h2>
        <h2><a href ="index.php?sort=dateUpdated">Date Updated</a></h2>
        
        </br>

        <?php if(!empty($sort)) : ?>
        <h2>Sorting by <?=$sort?></h2>
        <?php endif ?>
        <?php if($statement->rowCount() >= 1): ?>
    
          <?php while($row = $statement->fetch()): ?>
          <div class="game_post">
            <h2><a href="show.php?id=<?=$row['id'] ?>"><?=$row['name']?></a></h2>
            <p>
            <small>
              <a href="edit.php?id=<?=$row['id']?>">edit</a>
            </small>
            </p>
           <div class='game_content'>
             <p>Game: <?=$row['name']?></p>
             <p>Genre: <?=$row['genre']?></p>
             <p>User: <?=$row['username']?></p>
             <p>Date Created: <?=$row['dateCreated']?></p>
             <p>Date Updated: <?=$row['dateUpdated']?></p>
            </div>
          </div>
          <?php endwhile ?>
    <?php else: ?>
        <p>No rows found</p>
     <?php endif ?>
  <?php else: ?>
    <h1> <a href="register.html">Register for Account</a></h1>    
    <h1><a href ="login.php">Login</a></h1>
  <?php endif ?>




</body>
</html>
