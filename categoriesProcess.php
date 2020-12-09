<?php
    require 'connect.php';
    require 'loginProcess.php';
    session_start();

    $console = filter_input(INPUT_POST, 'console', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $query = "SELECT * FROM accounts WHERE username = '{$username}'";
    $statement = $db->prepare($query);
    $statement->execute();

    if(isset($_POST['id'])){
        //echo 'id is set';
       // echo $_POST['id'];
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $query = "UPDATE consoles SET console = :console WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':console', $console);
        $statement->bindValue(':id', $id);
        $statement->execute();
        header('Location: index.php');
        exit();
    }
    else{
        $query = "INSERT INTO consoles (console) values (:console)";
        $statement = $db->prepare($query);
        $statement->bindValue(':console', $console);
        $statement->execute();
        header('Location: index.php');
        exit();
    }

?>