<?php
    require 'adminAuthentication.php';
    require 'connect.php';
 
    $username = filter_input(INPUT_GET, 'usernameShown', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM accounts WHERE username = '{$username}'";
    $statement = $db->prepare($query);
    $statement->execute();


    $query = "SELECT * FROM accounts";
    $statementUsers = $db->prepare($query);
    $statementUsers->execute();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Show</title>
</head>
<body>
<h1><a href="index.php">Home</a></h1>
<form method="post">
<?php while($row = $statementUsers->fetch()): ?>
    <a href="editAccount.php?usernameShown=<?=$row['username']?>"><?=$row['username']?></a>
    <br>
<?php endwhile ?>
</form>

<form action="proccess_registration.php" method="post">
    <fieldset>
        <?php while($row = $statement->fetch()): ?>
            <legend>Edit Account <?=$row['username']?></legend>
            <p>
                <label for="username">Username</label>
                <input name="username" id="username" value="<?=$row['username']?>" />
            </p>
            <p>
                <label for="password">Password</label>
                <textarea name="password" id="password"><?=$row['password']?></textarea>
            </p>
            <p>
                <label for="email">Email</label>
                <textarea name="email" id="email"><?=$row['email']?></textarea>
            </p>
            <p>
                <input type="hidden" name="userId" value="<?=$row['userId']?>" />
                <input type="submit" name="command" value="Update" />
                <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this account?')" />
            </p>
        <?php endwhile ?>
    </fieldset>
  </form>
    <div id="footer">
        Copywrong 2020 - No Rights Reserved
    </div> 
</body>
</html>