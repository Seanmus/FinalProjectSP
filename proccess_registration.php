<!-------w--------

    Assignment 4
    Name: Sean Piche
    Date: Oct 6th 2020
    Description: Validates the users inputed data and saves records to the database.

----------------->
<?php
    require 'authenticate.php';
    require 'connect.php';

    function valid(){
        if(!filter_input(INPUT_POST, 'tweet', FILTER_SANITIZE_FULL_SPECIAL_CHARS) || strlen($_POST['tweet']) < 0){
            return false;
        }
        if(!filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS) || strlen($_POST['title']) < 0){
            return false;
        }
        return true;
    }
    if(valid()){
        $tweet = filter_input(INPUT_POST, 'tweet', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $submit_type = filter_input(INPUT_POST, 'command', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(isset($_POST['id'])){
            if($submit_type === 'Update'){
                $query = "UPDATE tweets SET tweet = :tweet, Title = :title, id = :id WHERE id = :id";
                $statement = $db->prepare($query);
                $statement->bindValue(':tweet', $tweet);
                $statement->bindValue(':title', $title);
                $statement->bindValue(':id', $id);
                $statement->execute();
            }
            else{
                $query = "DELETE FROM tweets WHERE id = :id";
                $statement = $db->prepare($query);
                $statement->bindValue(':id', $id);
                $statement->execute();
            }
        }
        else{
            $query = "INSERT INTO tweets (tweet, Title) values (:tweet, :title)";
            $statement = $db->prepare($query);
            $statement->bindValue(':tweet', $tweet);
            $statement->bindValue(':title', $title);
            $statement->execute();
        }
        header('Location: index.php');
        exit();
    }

    
    echo 'hi, your data has a bit of a boo boo please re enter.';


?>