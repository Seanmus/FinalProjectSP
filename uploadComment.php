<?php
    require 'connect.php';
    require 'loginProcess.php';
    session_start();

    $username = $_SESSION['username'];
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $itemId = filter_input(INPUT_POST, 'itemId', FILTER_VALIDATE_INT);

    $query = "INSERT INTO comments (itemId, username, comment) values (:itemId, :username, :comment)";
    $statement = $db->prepare($query);
    $statement->bindValue(':itemId', $itemId);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':comment', $comment);

    $statement->execute();
    header('Location: index.php');
    exit();

?>