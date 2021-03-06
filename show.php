<!-------w--------

    Assignment 4
    Name: Sean Piche
    Date:Nov 18th 2020
    Description: Shows the game by itself.

----------------->

<?php
    require 'connect.php';
    session_start();
    if(!filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)){
        header('Location: index.php');
        exit();
    }
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM games WHERE id = {$id}";
    $statement = $db->prepare($query);
    $statement->execute();

    $commentQuery ="SELECT * FROM comments WHERE itemId = {$id} ORDER BY dateCreated DESC";
    $commentStatement = $db->prepare($commentQuery);
    $commentStatement->execute();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Show</title>
</head>
<body>
    <?php while($row = $statement->fetch()): ?>
    <div id="wrapper">
    <div id="header">
        <h1><a href="index.php"><?=$row['name']?></a></h1>
    </div> <!-- END div id="header" -->
    <ul id="menu">
        <li><a href="index.php" >Home</a></li>
        <li><a href="create.php" >New Post</a></li>
    </ul> <!-- END div id="menu" -->
    <div id="all_blogs">
        <div class="game_post">
        <h2><?=$row['name']?></a></h2>
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
    </div>
    <div>
    <?php if (isset($_SESSION['username'])): ?>
        <form action="uploadComment.php" method="post">
                <input type="hidden" name="itemId" value="<?=$row['id']?>"/>
                <label for="comment">Comment</label>
                <textarea name="comment" id="comment"></textarea>
                <input type="submit" name="command" value="Update" />
        </form>
    </div>
    <div>
        <h1>Comments</h1>
        <?php while($commentRow = $commentStatement->fetch()): ?>
            <h2>User: <?=$commentRow['username']?></h2>
            <p>Date Created: <?=$commentRow['dateCreated']?></p>
            <p>Comment: <?=$commentRow['comment']?></p>
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                <a>You have administrative access<a>
                <h1> <a href = "removeComment.php?id=<?=$commentRow['id']?>">RemoveComment(Admins only!)</a></h1>
            <?php endif ?>
        <?php endwhile?>

    </div>
    <?php endif?>
    <?php endwhile ?>
        <div id="footer">
            Copywrong 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>