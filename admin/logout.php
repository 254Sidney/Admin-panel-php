<?php
require 'authentication/connection.php';
require 'authentication/function.php';
//session_destroy();
session_unset();
session_destroy();
header('Location: ' . 'login.php');
//$http_referer  this was making some problem 

?>