<?php
session_start();
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

    $sql = "SELECT empid FROM emp WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        die("Email already registered");
    }

    $sql = "INSERT INTO emp (full_name, mobile_number, email, password) VALUES ('$full_name', '$mobile', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Get the empid of the newly created employer
        $empid = $conn->insert_id;
        // Set the empid in the session
        $_SESSION['empid'] = $empid;
        header("Location: /dmw-coursework/empdash.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>