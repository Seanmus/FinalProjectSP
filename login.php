<?php

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Show</title>
</head>
<body>

    <form action = "searchResults.php" id = "form" method="POST">
      <label for="title">Search for a game by title</label>
      <input type="text" id = "title" name="title">
      <button type="submit">Submit search</button>
    </form>
    </br>
    <h1><a href="index.php">Home</a></h1>

<form action="loginProcess.php" method="post">
        <p>
            <label for="username">Username</label>
            <textarea name="username" id="username"></textarea>
        </p>
        <p>
            <label for="password">Password</label>
            <textarea name="password" id="password"></textarea>
        </p>
        <button type="submit">Submit Account</button>
  </form>
    <div id="footer">
        Copywrong 2020 - No Rights Reserved
    </div> 
</body>
</html>