<?php
$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$db = "jashney_db"; 

//Creat Connection
$conn = new mysqli($host, $user, $pass, $db);

//Check Connection
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}
?>