<?php
    
ini_set('display_errors, 1');
ini_set('error_reporting', E_ALL);
 echo "Hello IP: " . $_SERVER['REMOTE_ADDR'] . "</br>";
     
 echo "You are served by the server IP: <b>" . $_SERVER['SERVER_ADDR'] . "</b></br>";
      
 $datetime = date("j F, Y, g:i a");
      
 echo "on: <b>" . $datetime . "</b>";
     
 ?>
