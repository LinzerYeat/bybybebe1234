<?php
$host = "localhost";
$user = "root"; 
$password = ""; 
$database = "mobile_shop"; 

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
?>