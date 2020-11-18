<?php
    session_start();
    require 'connect.php';
    $query = "SELECT * FROM games ORDER BY username";
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
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
        <h2>You have administrative access<h2>
        <h1> <a href = "editAccount.php">Manage Accounts (Admins only!)</a></h1>
    <?php endif ?>
    <?php if (isset($_SESSION['username'])): ?>
        <h2>Welcome <?=$_SESSION['username']?><h2>
        <h1> <a href = "logout.php">Logout</a></h1>
        <h1><a href ="create.php">Enter a record</a></h1>
    <?php endif ?>
    <h1> <a href="register.html">Register for Account</a></h1>    
    <h1><a href ="login.php">Login</a></h1>


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
        </div>
    </div>
    <?php endwhile ?>
    <?php else: ?>
        <p>No rows found</p>
  <?php endif ?>
</body>
</html>
