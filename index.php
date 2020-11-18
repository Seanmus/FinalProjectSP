<?php
    session_start();
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
    <?php endif ?>
    <h1> <a href="register.html">Register for Account</a></h1>    
    <h1><a href ="login.php">Login</a></h1>
</body>
</html>
