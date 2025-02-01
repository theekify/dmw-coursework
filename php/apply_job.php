<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $app_job_id = intval($_POST["app_job_id"]);
    $app_full_name = $_POST["app_full_name"];
    $app_email = $_POST["app_email"];
    $app_phone = $_POST["app_phone"];
    $app_address = $_POST["app_address"];
    $app_linkedin_link = $_POST["app_linkedin_link"];
    $app_github_link = isset($_POST["app_github_link"]) ? $_POST["app_github_link"] : NULL;

    // Handle CV file upload
    $app_cv_file = NULL;
    if (isset($_FILES["app_cv_file"]) && $_FILES["app_cv_file"]["error"] == 0) {
        $allowed_types = ["application/pdf"];
        $file_type = $_FILES["app_cv_file"]["type"];

        if (in_array($file_type, $allowed_types)) {
            $cv_dir = "uploads/";
            if (!is_dir($cv_dir)) {
                mkdir($cv_dir, 0777, true);
            }

            $app_cv_file = $cv_dir . basename($_FILES["app_cv_file"]["name"]);
            move_uploaded_file($_FILES["app_cv_file"]["tmp_name"], $app_cv_file);
        } else {
            echo "<script>alert('Only PDF files are allowed!'); window.history.back();</script>";
            exit();
        }
    }

    // Insert application into database
    $sql = "INSERT INTO applications (app_job_id, app_full_name, app_email, app_phone, app_address, app_linkedin_link, app_github_link, app_cv_file) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssss", $app_job_id, $app_full_name, $app_email, $app_phone, $app_address, $app_linkedin_link, $app_github_link, $app_cv_file);

    if ($stmt->execute()) {
        echo "<script>alert('Application submitted successfully!'); window.close();</script>";
    } else {
        echo "<script>alert('Error submitting application!');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
