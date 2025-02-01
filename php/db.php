<?php
$host = "localhost";  // Change if necessary
$username = "root";   // Database username
$password = "orypubit";       // Database password
$dbname = "hiredly";  // Database name

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
