<?php

$host = "localhost";
$user = "root";
$password = "orypubit";
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

    $stmt = $conn->prepare("SELECT freelanid FROM freelan WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Email already registered");
    }

    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO freelan (full_name, mobile_number, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $full_name, $mobile, $email, $password);

    if ($stmt->execute() === TRUE) {
        header("Location: /dmw-coursework/freelan.php");
        exit();
    } else {
        echo "An error occurred. Please try again later.";
    }

    $stmt->close();
    $conn->close();
}

?>