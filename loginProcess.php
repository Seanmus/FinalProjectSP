<?php
    session_start();
    if(!isset($_SESSION['password']) || !isset($_SESSION['username'])) {
        require 'connect.php';

    
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        $query = "SELECT * FROM accounts WHERE username = '{$username}' AND password = '{$password}'";
        $statement = $db->prepare($query);
        $statement->execute();
        $admins = $statement->fetchAll();
    
        $rowCount = $statement->rowCount();
        if(!$rowCount > 0)
        {
            session_destroy();
            header('HTTP/1.1 401 Unauthorized');
    
            exit("Access Denied: Inccorect Credentials.");
    
            echo 'unsuccessful login';
        }
        else
        {   
            $_SESSION['password'] = $password;
            $_SESSION['username'] = $username;
            foreach($admins as $admin)
            {
                $_SESSION['admin'] = $admin['admin'];
            }
            header('Location: index.php');
            exit();
        }
    }

?>
