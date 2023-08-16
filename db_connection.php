<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laptop";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
?>