<?php
    require 'connect.php';
    require 'loginProcess.php';
    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $platform = filter_input(INPUT_POST, 'platform', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gameCondition = filter_input(INPUT_POST, 'gameCondition', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = $_SESSION['username'];

    $query = "INSERT INTO games (name, genre, platform, gameCondition, username) values (:name, :genre, :platform ,  :gameCondition, :username)";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':genre', $genre);
    $statement->bindValue(':platform', $platform);
    $statement->bindValue(':gameCondition', $gameCondition);
    $statement->bindValue(':username', $username);

    $statement->execute();
    header('Location: index.php');
    exit();
?>