<!-------w--------

    Assignment 4
    Name: Sean Piche
    Date:Nov 8th 2020
    Description: Ensures the user is an administrator.

----------------->
<?php
    session_start();
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1)  
    {
        header('HTTP/1.1 401 Unauthorized');
        exit("Access Denied: Not an administrator.");
    }

   

?>