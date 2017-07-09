<?php 

$user = 'root';
$password = '';
$db = 'acepro';
$host = 'localhost';

/*
$user = 'admininvdb';
$password = 'Sm533106';
$db = 'invdatadb';
$host = 'mysql.selikta.com';
*/

$conn = mysqli_connect(
   "$host", 
   $user, 
   $password,
   $db
);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>