<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "achievement";

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}



// NO CLOSING ?> 
