<?php
require_once 'db.php'; // Ensure database connection is included

$app_job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;
$job_title = "";

// Fetch job title from database
if ($app_job_id > 0) {
    $sql = "SELECT title FROM jobs WHERE job_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $app_job_id);
    $stmt->execute();
    $stmt->bind_result($job_title);
    $stmt->fetch();
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <style>
        :root {
  --primary-green: #0B4D2C;
  --white: #ffffff;
  --light-gray: #f8f9fa;
  --border-color: #e9ecef;
  --text-primary: #212529;
  --text-secondary: #6c757d;
  --focus-ring: rgba(11, 77, 44, 0.25);
}

body {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
  margin: 0;
  min-height: 100vh;
  background-color: var(--light-gray);
  color: var(--text-primary);
  line-height: 1.5;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 2rem 1rem;
}

h2 {
  color: var(--primary-green);
  font-size: 1.75rem;
  font-weight: 600;
  margin-bottom: 2rem;
  text-align: center;
}

form {
  width: 100%;
  max-width: 640px;
  background-color: var(--white);
  padding: 2rem;
  border-radius: 12px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: var(--text-primary);
  font-size: 0.875rem;
}

input[type="text"],
input[type="email"],
input[type="url"],
input[type="file"] {
  width: 100%;
  padding: 0.75rem 1rem;
  margin-bottom: 1.5rem;
  background-color: var(--white);
  border: 1.5px solid var(--border-color);
  border-radius: 8px;
  font-size: 0.875rem;
  transition: all 0.2s ease;
  box-sizing: border-box;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="url"]:focus {
  outline: none;
  border-color: var(--primary-green);
  box-shadow: 0 0 0 4px var(--focus-ring);
}

input[type="file"] {
  padding: 0.5rem;
  font-size: 0.875rem;
  color: var(--text-secondary);
}

input[type="file"]::file-selector-button {
  background-color: var(--light-gray);
  color: var(--text-primary);
  padding: 0.5rem 1rem;
  border: 1.5px solid var(--border-color);
  border-radius: 6px;
  font-size: 0.875rem;
  margin-right: 1rem;
  cursor: pointer;
  transition: all 0.2s ease;
}

input[type="file"]::file-selector-button:hover {
  background-color: var(--border-color);
}

button[type="submit"] {
  background-color: var(--primary-green);
  color: var(--white);
  width: 100%;
  padding: 0.875rem;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
  margin-top: 1rem;
}

button[type="submit"]:hover {
  background-color: #094225;
  transform: translateY(-1px);
}

button[type="submit"]:active {
  transform: translateY(0);
}

/* Modern form validation styles */
input:invalid {
  border-color: #dc3545;
}

input:invalid:focus {
  border-color: #dc3545;
  box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.25);
}

/* Optional: Add subtle animation for form elements */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

form {
  animation: fadeIn 0.3s ease-out;
}

/* Responsive design */
@media (max-width: 768px) {
  body {
    padding: 1rem;
  }
  
  form {
    padding: 1.5rem;
  }
  
  h2 {
    font-size: 1.5rem;
  }
}

</style>
    <h2>Apply for Job</h2>
    <form action="apply_job.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="app_job_id" value="<?php echo $app_job_id; ?>">
        
        <label>Full Name:</label>
        <input type="text" name="app_full_name" required><br>

        <label>Email:</label>
        <input type="email" name="app_email" required><br>

        <label>Phone Number:</label>
        <input type="text" name="app_phone" required><br>

        <label>Address:</label>
        <input type="text" name="app_address" required><br>

        <label>LinkedIn Profile:</label>
        <input type="url" name="app_linkedin_link"><br>

        <label>GitHub Profile:</label>
        <input type="url" name="app_github_link"><br>

        <label>Upload CV (PDF only):</label>
        <input type="file" name="app_cv_file" accept=".pdf" required><br>

        <button type="submit">Submit Application</button>
    </form>
</body>
</html>
