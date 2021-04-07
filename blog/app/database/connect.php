<?php
$servername = "localhost";
$username = "PrinceKelvin";
$password = "PrinceKelvin@25";
$database = "blog";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
