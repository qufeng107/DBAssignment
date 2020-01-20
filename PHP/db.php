<?php
$host = "silva.computing.dundee.ac.uk";
$username = $_SESSION['usernamedb'];
$password = "abc213";
$database = "19ac3d12";
$mysql = new PDO("mysql:host=".$host.";dbname=".$database,$username, $password);
?>
