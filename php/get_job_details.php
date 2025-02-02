<?php
include 'db.php';

if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $sql = "SELECT * FROM jobs WHERE job_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($job = $result->fetch_assoc()) {
        echo json_encode($job);
    } else {
        echo json_encode(["error" => "Job not found"]);
    }
}
?>
