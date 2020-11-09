<!-------w--------

    Final Project 
    Name: Sean Piche
    Date: Nov 7th 2020
    Description: Validates the users inputed data and saves records to the database.

----------------->
<?php
    require 'connect.php';

    $noErrors = true; 

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM accounts";
    $statement = $db->prepare($query);
    $statement->execute();


    while($row = $statement->fetch()){
        if($row['username'] === $username){
            $noErrors = false;
            echo 'username already exists';
        }
    }
    

    


    function valid(){
        if(!filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS) || strlen($_POST['username']) < 0){
            echo 'invalid username';
            return false;
        }
        if(!filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS) || strlen($_POST['password']) < 0){
            echo 'invalid password';
            return false;
        }
        if(!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){
            echo 'invalid email';
            return false;
        }
        return true;
    }
    if(valid() &&  $noErrors){

        //$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $query = "INSERT INTO accounts (username, password, email) values (:username, :password, :email)";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':email', $email);
        $statement->execute();

        //header('Location: index.php');
        //exit();
    }

    
    //echo 'hi, your data has a bit of a boo boo please re enter.';


?>