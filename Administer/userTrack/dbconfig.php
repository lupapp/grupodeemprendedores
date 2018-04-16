<?php
$host = "localhost";
$username = "proveed8_admin"; // MySQL username 
$password = "Drako521"; // MySQL password 
$db_name = "proveed8_admin"; // Database name 

try {
    $db = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $username , $password,
                  array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
                  );
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
         
?>
