<?php
$localhost = "localhost";
$user = "root";
$password = "";
$dbname = "clients";

$conn = new mysqli($localhost, $user, $password, $dbname);

if($conn->connection_error){
   die("Connection Failer: " . $conn->connection_error);
}
?>