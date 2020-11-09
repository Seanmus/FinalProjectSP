<!-------w--------

    Assignment 4
    Name: Sean Piche
    Date:Oct 6th 2020
    Description: Ensures the user is logged in.

----------------->
<?php
  

  define('ADMIN_LOGIN','T208');

  define('ADMIN_PASSWORD','Duncan33');


  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])

      || ($_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN)

      || ($_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD)) {

    header('HTTP/1.1 401 Unauthorized');

    header('WWW-Authenticate: Basic realm="Our Blog"');

    exit("Access Denied: Username and password required.");

  }

   

?>