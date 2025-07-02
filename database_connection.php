<?php

$host = 'localhost';
$dbname = 'feedback_management_system';
$username = 'root'; 
$password = 'root'; 


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "success";

} catch (PDOException $e) {
    
    die("Connection failed: " . $e->getMessage());
}
?>
