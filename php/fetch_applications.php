<?php
include 'db.php';

$freelanid = 1; // Replace with actual logged-in freelancer ID

$sql = "SELECT a.application_id, j.title, j.company, a.applied_date, a.status 
        FROM applications a
        JOIN jobs j ON a.job_id = j.job_id
        WHERE a.freelanid = '$freelanid' 
        ORDER BY a.applied_date DESC";

$result = $conn->query($sql);
$applications = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $applications[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($applications);
?>
