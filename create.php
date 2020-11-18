<?php
    require 'loginProcess.php'
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
    <h1>Enter in the details of your game details.</h1>
    <form id = "game" action="createProcess.php" method="post">

        <label for="name">Name of Item</label>
        <input type="text" id = "name" name="name">
        <p id="nameError">* The name is required.</p>

        <label for="genre">Genre</label>
        <input type="text" id = "genre" name="genre">

        <label for="platform">Platform</label>
        <input type="text" id = "platform" name="platform">
        <p id="platformError">* The platform is required.</p>

        <label for="condition">Condition</label>
        <input type="text" id = "gameCondition" name="gameCondition">
        
        <button type="submit">Submit Game</button>
    </form>
</body>
</html>