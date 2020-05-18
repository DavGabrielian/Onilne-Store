<?php

session_start();
$host = "localhost"; // Host name 
$user = "root"; // User 
$password = ""; // Password 
$dbname = "storedb"; // Database name 

$link = mysqli_connect($host, $user, $password, $dbname);


if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
