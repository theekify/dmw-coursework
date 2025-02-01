<?php
// Include database connection
include 'db.php';

// Fetch job details
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $result = $conn->query("SELECT * FROM jobs WHERE job_id = $job_id");
    $job = $result->fetch_assoc();
}

// Handle job update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_job'])) {
    $title = $_POST['title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $salary_min = $_POST['salary_min'];
    $salary_max = $_POST['salary_max'];
    $description = $_POST['description'];
    $requirements = $_POST['requirements'];

    $sql = "UPDATE jobs SET 
                title = '$title', 
                company = '$company', 
                location = '$location', 
                salary_min = '$salary_min', 
                salary_max = '$salary_max', 
                description = '$description', 
                requirements = '$requirements' 
            WHERE job_id = $job_id";

    $conn->query($sql);
    header("Location: successjob.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job - Hiredly</title>
    <link rel="stylesheet" href="edit_job.css">
</head>
<body>

<main class="container">
    <h2>Edit Job Posting</h2>
    <form class="job-form" method="POST">
        <div class="form-group">
            <label for="title">Job Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $job['title']; ?>" required>
        </div>
        <div class="form-group">
            <label for="company">Company Name:</label>
            <input type="text" id="company" name="company" value="<?php echo $job['company']; ?>" required>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="<?php echo $job['location']; ?>" required>
        </div>
        <div class="form-group">
            <label for="salary_min">Minimum Salary:</label>
            <input type="number" id="salary_min" name="salary_min" value="<?php echo $job['salary_min']; ?>" required>
        </div>
        <div class="form-group">
            <label for="salary_max">Maximum Salary:</label>
            <input type="number" id="salary_max" name="salary_max" value="<?php echo $job['salary_max']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Job Description:</label>
            <textarea id="description" name="description" required><?php echo $job['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="requirements">Requirements:</label>
            <textarea id="requirements" name="requirements" required><?php echo $job['requirements']; ?></textarea>
        </div>
        <button type="submit" name="update_job" class="btn">Update Job</button>
    </form>
</main>

</body>
</html>