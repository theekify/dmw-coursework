<?php
session_start();
require_once 'db.php';

// Check if the employer is logged in
if (!isset($_SESSION['empid'])) {
    die("You are not logged in.");
}

$empid = $_SESSION['empid'];

// Handle job posting
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_job'])) {
    $title = $_POST['title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $salary_min = $_POST['salary_min'];
    $salary_max = $_POST['salary_max'];
    $description = $_POST['description'];
    $requirements = $_POST['requirements'];

    $sql = "INSERT INTO jobs (title, company, location, salary_min, salary_max, description, requirements, empid) 
            VALUES ('$title', '$company', '$location', '$salary_min', '$salary_max', '$description', '$requirements', '$empid')";
    $conn->query($sql);
}

// Handle job deletion (Close Job Button)
if (isset($_GET['delete_job'])) {
    $job_id = $_GET['delete_job'];
    $conn->query("DELETE FROM jobs WHERE job_id = $job_id");
}

// Fetch jobs
$jobs = $conn->query("SELECT * FROM jobs WHERE empid = $empid");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Dashboard - Hiredly</title>
    <link rel="stylesheet" href="emp.css">
</head>
<body>

<header>
    <div class="container">
        <h1>Hiredly</h1>
        <nav>
            <ul>
               
                <li><a href="#post-job">Post Job</a></li>
                <li><a href="#manage-jobs">Manage Jobs</a></li>
                <li><a href="applications.php">View Applications</a></li>

            </ul>
        </nav>

        <div class="user-menu" style="display: flex; align-items: center; gap: 1.5rem;">
    <span style="color: #666666; font-size: 1rem;">Employer</span>
    <a href="logout.php" class="logout-btn" style="padding: 0.5rem 1rem; background-color: #0b4d2c; color: white; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 0.9375rem; transition: all 0.2s ease;">Logout</a>
</div>
    </div>
</header>

<main class="container">    

    <!-- Post Job Section -->
   <section id="post-job">
    <h2 style="text-align: center;">Post a New Job</h2>
    <form class="job-form" method="POST" style="display: grid; gap: 1.25rem; max-width: 800px; margin: 0 auto;">
        <input type="text" name="title" placeholder="Job Title" required 
            style="  width: 100%; height: 48px; padding: 0.75rem 1rem;
                    margin-bottom: 0.5rem; border: 1.5px solid #e9ecef; border-radius: 8px; font-size: 0.875rem; transition: all 0.2s ease;
                    box-sizing: border-box; font-family: -apple-system, system-ui, sans-serif; font-size: 14px; line-height: 1.5; color: #333; background-color: #fff;">
        
        <input type="text" name="company" placeholder="Company Name" required 
        style="width: 100%; height: 48px; padding: 0.75rem 1rem;
                    margin-bottom: 0.5rem; border: 1.5px solid #e9ecef; border-radius: 8px; font-size: 0.875rem; transition: all 0.2s ease;
                    box-sizing: border-box; font-family: -apple-system, system-ui, sans-serif; font-size: 14px; line-height: 1.5; color: #333; background-color: #fff;">
        
        <input type="text" name="location" placeholder="Location" required 
        style="width: 100%; height: 48px; padding: 0.75rem 1rem;
                    margin-bottom: 0.5rem; border: 1.5px solid #e9ecef; border-radius: 8px; font-size: 0.875rem; transition: all 0.2s ease;
                    box-sizing: border-box; font-family: -apple-system, system-ui, sans-serif; font-size: 14px; line-height: 1.5; color: #333; background-color: #fff;">
        
        <input type="number" name="salary_min" placeholder="Min Salary" required 
        style="width: 100%; height: 48px; padding: 0.75rem 1rem;
                    margin-bottom: 0.5rem; border: 1.5px solid #e9ecef; border-radius: 8px; font-size: 0.875rem; transition: all 0.2s ease;
                    box-sizing: border-box; font-family: -apple-system, system-ui, sans-serif; font-size: 14px; line-height: 1.5; color: #333; background-color: #fff;">
        
        <input type="number" name="salary_max" placeholder="Max Salary" required 
        style="width: 100%; height: 48px; padding: 0.75rem 1rem;
                    margin-bottom: 0.5rem; border: 1.5px solid #e9ecef; border-radius: 8px; font-size: 0.875rem; transition: all 0.2s ease;
                    box-sizing: border-box; font-family: -apple-system, system-ui, sans-serif; font-size: 14px; line-height: 1.5; color: #333; background-color: #fff;">
        
        <textarea name="description" placeholder="Job Description" required 
        style="width: 100%; height: 48px; padding: 0.75rem 1rem;
                    margin-bottom: 0.5rem; border: 1.5px solid #e9ecef; border-radius: 8px; font-size: 0.875rem; transition: all 0.2s ease;
                    box-sizing: border-box; font-family: -apple-system, system-ui, sans-serif; font-size: 14px; line-height: 1.5; color: #333; background-color: #fff;"></textarea>
        
        <textarea name="requirements" placeholder="Job Requirements" required 
        style="width: 100%; height: 48px; padding: 0.75rem 1rem;
                    margin-bottom: 0.5rem; border: 1.5px solid #e9ecef; border-radius: 8px; font-size: 0.875rem; transition: all 0.2s ease;
                    box-sizing: border-box; font-family: -apple-system, system-ui, sans-serif; font-size: 14px; line-height: 1.5; color: #333; background-color: #fff;"></textarea>
        
        <button type="submit" name="post_job" class="btn" 
            style="height: 48px; font-size: 14px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; background-color: #0b4d2c; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Post Job</button>
            
            <style>
            input:invalid {
  border-color: #dc3545;
}

input:invalid:focus {
  border-color: #dc3545;
  box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.25);
}




@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

form {
  animation: fadeIn 0.3s ease-out;
}


</style>
    
        </form>
</section>

    <!-- Manage Jobs Section -->
    <section id="manage-jobs">
        <h2>Manage Jobs</h2>
        <table class="job-table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Salary Range</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($job = $jobs->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $job['title']; ?></td>
                    <td><?php echo $job['company']; ?></td>
                    <td><?php echo $job['location']; ?></td>
                    <td>$<?php echo $job['salary_min']; ?> - $<?php echo $job['salary_max']; ?></td>
                    <td>
                        <a href="edit_job.php?job_id=<?php echo $job['job_id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="?delete_job=<?php echo $job['job_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this job?');">Close</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>

</main>

<footer>
    <div class="container">
        <p>&copy; 2025 Hiredly. All rights reserved.</p>
    </div>
</footer>

</body>
</html>