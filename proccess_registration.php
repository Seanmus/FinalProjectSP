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
    $deleteCheckBox = filter_input(INPUT_POST, 'deleteImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM accounts WHERE username = '{$username}'";
    $statement = $db->prepare($query);
    $statement->execute();



    
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
    if(valid()){
        if(isset($_POST['userId']))
        {

            $submit_type = filter_input(INPUT_POST, 'command', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userId = filter_input(INPUT_POST, 'userId', FILTER_VALIDATE_INT);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

            while($row = $statement->fetch()){
                $imagePath = 'uploads/' . $row['profilePhoto'];
            }

            echo $imagePath;
            print_r($submit_type);
            if($submit_type === 'Update'){
                if($deleteCheckBox === 'delete'){
                    if (file_exists($imagePath)) 
                    {
                       unlink($imagePath);
                       echo "File Successfully Deleted."; 
                   }
                    $query = "UPDATE accounts SET userId = :userId, username = :username, password = :password, email = :email, profilePhoto = :profilePhoto WHERE userId = :userId";
                    $statement = $db->prepare($query);
                    $statement->bindValue(':userId', $userId);
                    $statement->bindValue(':username', $username);
                    $statement->bindValue(':password', $password);
                    $statement->bindValue(':email', $email);
                    $statement->bindValue(':profilePhoto', null);
                    $statement->execute();
                }
                else{
                    $query = "UPDATE accounts SET userId = :userId, username = :username, password = :password, email = :email WHERE userId = :userId";
                    $statement = $db->prepare($query);
                    $statement->bindValue(':userId', $userId);
                    $statement->bindValue(':username', $username);
                    $statement->bindValue(':password', $password);
                    $statement->bindValue(':email', $email);
                    $statement->execute();
                }

                    header('Location: profilePhoto.php');
                    exit();
            }
            else{
                $query = "DELETE FROM accounts WHERE userId = :userId";
                $statement = $db->prepare($query);
                $statement->bindValue(':userId', $userId);
                $statement->execute();
                header('Location: index.php');
                exit();
            }
            
        }
        else{
            if($noErrors)
            {
                while($row = $statement->fetch()){
                    if($row['username'] === $username){
                        $noErrors = false;
                        echo 'username already exists';
                    }
                }
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $query = "INSERT INTO accounts (username, password, email) values (:username, :password, :email)";
                $statement = $db->prepare($query);
                $statement->bindValue(':username', $username);
                $statement->bindValue(':password', $password);
                $statement->bindValue(':email', $email);
                $statement->execute();

                session_start();
                $_SESSION['password'] = $password;
                $_SESSION['username'] = $username;

                header('Location: profilePhoto.php');
                exit();
            }
        }      
    }

?>