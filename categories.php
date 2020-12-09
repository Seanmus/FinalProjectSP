<?php
        require 'loginProcess.php';
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

    <h1>Enter in the Console you want to add.</h1>
    <form id = "game" action="categoriesProcess.php" method="post">

        <label for="name">Add a Console</label>
        <input type="text" id = "console" name="console">
        
        <button type="submit">Submit Console</button>
    </form>
</body>
</html>