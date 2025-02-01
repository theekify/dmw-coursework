<?php
include 'db.php';

$search = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

$sql = "SELECT * FROM jobs WHERE title LIKE '%$search%' OR company LIKE '%$search%' OR location LIKE '%$search%'";
$result = $conn->query($sql);

$jobs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($jobs);
?>
