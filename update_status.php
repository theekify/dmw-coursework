<?php
session_start();
include 'db.php';

if (!isset($_SESSION['empid'])) {
    die("Unauthorized access.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $application_id = $_POST['application_id'];
    $new_status = $_POST['status'];

    // Update status in the database
    $sql = "UPDATE applications a
            JOIN jobs j ON a.job_id = j.job_id
            SET a.status = ?
            WHERE a.application_id = ? AND j.empid = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $new_status, $application_id, $_SESSION['empid']);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
