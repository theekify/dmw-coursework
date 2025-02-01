<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Dashboard - Hiredly</title>
    <link rel="stylesheet" href="freelan.css">
</head>
<body>
    <header>
    <div class="container">
        <h1>Hiredly</h1>
        <nav>
            <ul>
                <li><a href="#job-listings" class="active">Job Listings</a></li>
                <li><a href="application.php">My Applications</a></li>
            </ul>
        </nav>
        <div class="user-menu">
            <span>Freelancer</span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
</header>

    <main class="container">

        <section id="search">
        <form class="search-form" onsubmit="searchJobs(event)">
    <input type="text" id="search-input" placeholder="Search jobs..." class="search-input">
    <button type="submit" class="btn">Search</button>
</form>

<script>
    function searchJobs(event) {
        event.preventDefault();
        let query = document.getElementById("search-input").value;
        
        fetch(`php/search_jobs.php?q=${query}`)
            .then(response => response.json())
            .then(data => {
                let jobListHTML = "";
                data.forEach(job => {
                    jobListHTML += `
                        <div class="job-card">
                            <h3>${job.title}</h3>
                            <p class="company">${job.company}</p>
                            <p class="location">${job.location}</p>
                            <p class="salary">$${job.salary_min} - $${job.salary_max}</p>
                            <a href="#" class="btn btn-small" onclick="applyJob(${job.job_id})">Apply Now</a>
                        </div>`;
                });
                document.getElementById("job-listings").innerHTML = jobListHTML;
            });
    }
</script>

        </section>

        <section id="job-listings">
            <h2>Job Listings</h2>
            <div class="job-list" id="job-listings">
                <?php
                include 'php/db.php'; // Include the database connection
            
                $sql = "SELECT * FROM jobs ORDER BY created_at DESC";
                $result = $conn->query($sql);
            
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                            <div class="job-card">
                                <h3>' . htmlspecialchars($row["title"]) . '</h3>
                                <p class="company">' . htmlspecialchars($row["company"]) . '</p>
                                <p class="location">' . htmlspecialchars($row["location"]) . '</p>
                                <p class="salary">$' . number_format($row["salary_min"]) . ' - $' . number_format($row["salary_max"]) . '</p>
                                <a href="#" class="btn btn-small" onclick="applyJob(1)">Apply Now</a>

                            </div>';
                    }
                } else {
                    echo "<p>No jobs found.</p>";
                }
                ?>
            </div>
            
        </section>




    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Hiredly. All rights reserved.</p>
        </div>
    </footer>


    <script>
    function applyJob(job_id) {
        window.open(`apply_form.php?job_id=${job_id}`, "_blank");
    }
</script>



</body>
</html>

