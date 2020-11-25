<?php
    require 'connect.php';
    require 'loginProcess.php';
    session_start();

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $platform = filter_input(INPUT_POST, 'platform', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gameCondition = filter_input(INPUT_POST, 'gameCondition', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $submit_type = filter_input(INPUT_POST, 'command', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $current_date = date("Y-m-d");
    $username = $_SESSION['username'];

    if(isset($_POST['id'])){
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if($submit_type === 'Update'){
            $query = "UPDATE games SET name = :name, genre = :genre, platform = :platform, gameCondition = :gameCondition, username = :username, dateUpdated = :current_date , id = :id WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':genre', $genre);
            $statement->bindValue(':platform', $platform);
            $statement->bindValue(':gameCondition', $gameCondition);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':id', $id);
            $statement->bindValue(':current_date', $current_date);

            $statement->execute();
            header('Location: index.php');
            exit();
        }
        else{
            $query = "DELETE FROM games WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
            
            header('Location: index.php');
            exit();
        }
    }
    else{
        $query = "INSERT INTO games (name, genre, platform, gameCondition, username, dateCreated, dateUpdated) values (:name, :genre, :platform ,  :gameCondition, :username, :current_date, :current_date)";
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':genre', $genre);
        $statement->bindValue(':platform', $platform);
        $statement->bindValue(':gameCondition', $gameCondition);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':current_date', $current_date);

        $statement->execute();
        header('Location: index.php');
        exit();
    }

?>