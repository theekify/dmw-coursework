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
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT email, password FROM freelan WHERE email = '$email'";
    $result = $conn->query($sql);

    
        if ($password == $row['password']) { 
            $_SESSION['user_email'] = $row['email'];
            header("Location: /dmw-coursework/empdash.html");
        exit();
        } else {
            echo "Invalid email or password";
        }
    }


$conn->close();
?>