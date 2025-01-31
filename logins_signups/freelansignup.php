<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "hiredly";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (empty($full_name) || empty($mobile) || empty($email) || empty($password)) {
        die("All fields are required");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    if (strlen($password) < 8) {
        die("Password must be at least 8 characters");
    }


    $sql = "SELECT id FROM freelan WHERE email = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        die("Email already registered");
    }

    $sql = "INSERT INTO freelan (full_name, mobile_number, email, password) VALUES ('$full_name', '$mobile', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Account created successfully";
    } else {
        echo "An error occurred. Please try again later.";
    }
}

$conn->close();
?>