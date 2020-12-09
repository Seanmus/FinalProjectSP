<?php
    require 'connect.php';
    require 'adminAuthentication.php';
    session_start();

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $query = "DELETE FROM comments WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
            
    header('Location: index.php');
    exit();
?>