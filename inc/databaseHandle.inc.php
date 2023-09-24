<?php
# Database handling file.
$host = "localhost";
$dbname = "gamemanagment";
$username = "root";
$password = "";

# Initializing connection with the database.
try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(Exception $e){
    echo 'connection failed '.$e;
}

?> 
