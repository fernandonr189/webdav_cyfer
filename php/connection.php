<?php
$servername = "www.cyferdb.com";
$username = "example_user";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password, "cyfer_user_database");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
