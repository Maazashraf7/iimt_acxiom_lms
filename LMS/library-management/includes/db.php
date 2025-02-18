<?php
$servername = "localhost";
$username = "maaz"; // Your database username
$password = "maaz@123"; // Your database password
$dbname = "lms"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "goog";
?>
echo "goog";