<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Dashboard - Hiredly</title>
    <link rel="stylesheet" href="free.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Hiredly</h1>
            <nav>
                <ul>
                    <li><a href="#job-listings" class="active">Job Listings</a></li>
                    <li><a href="search_applications.html" class = "active">My Applications</a></li>

                </ul>
            </nav>
            <div class="user-menu">
                <span>Freelancer</span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
    </header>

    <main class="container">

        <!-- Search Section -->
        <section id="search">
            <form class="search-form" onsubmit="searchJobs(event)">
                <input type="text" id="search-input" placeholder="Search jobs..." class="search-input">
                <button type="submit" class="btn">Search</button>
            </form>
        </section>

        <!-- Job Listings -->
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
                            <div class="job-card" onclick="openJobModal(' . $row["job_id"] . ')">
                                <h3>' . htmlspecialchars($row["title"]) . '</h3>
                                <p class="company"><strong>Company:</strong> ' . htmlspecialchars($row["company"]) . '</p>
                                <p class="location"><strong>Location:</strong> ' . htmlspecialchars($row["location"]) . '</p>
                                <p class="salary"><strong>Salary:</strong> $' . number_format($row["salary_min"]) . ' - $' . number_format($row["salary_max"]) . '</p>
                            </div>';
                    }
                } else {
                    echo "<p>No jobs found.</p>";
                }
                ?>
            </div>
        </section>

        <!-- Job Details Modal -->
        <div id="jobModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeJobModal()">&times;</span>
                <h2 id="modal-title"></h2>
                <p><strong>Company:</strong> <span id="modal-company"></span></p>
                <p><strong>Location:</strong> <span id="modal-location"></span></p>
                <p><strong>Salary:</strong> <span id="modal-salary"></span></p>
                <p><strong>Description:</strong> <span id="modal-description"></span></p>
                <p><strong>Requirements:</strong> <span id="modal-requirements"></span></p>
                <a id="apply-link" href="#" target="_blank" class="btn">Apply Now</a>
            </div>
        </div>

    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Hiredly. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript -->
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
                            <div class="job-card" onclick="openJobModal(${job.job_id})">
                                <h3>${job.title}</h3>
                                <p class="company"><strong>Company:</strong> ${job.company}</p>
                                <p class="location"><strong>Location:</strong> ${job.location}</p>
                                <p class="salary"><strong>Salary:</strong> $${job.salary_min} - $${job.salary_max}</p>
                            </div>`;
                    });
                    document.getElementById("job-listings").innerHTML = jobListHTML;
                })
                .catch(error => console.error("Error fetching jobs:", error));
        }

        function openJobModal(jobId) {
            fetch(`php/get_job_details.php?job_id=${jobId}`)
                .then(response => response.json())
                .then(job => {
                    document.getElementById("modal-title").innerText = job.title;
                    document.getElementById("modal-company").innerText = job.company;
                    document.getElementById("modal-location").innerText = job.location;
                    document.getElementById("modal-salary").innerText = `$${job.salary_min} - $${job.salary_max}`;
                    document.getElementById("modal-description").innerText = job.description;
                    document.getElementById("modal-requirements").innerText = job.requirements;
                    document.getElementById("apply-link").href = `apply_form.php?job_id=${jobId}`;

                    document.getElementById("jobModal").style.display = "block";
                })
                .catch(error => console.error("Error fetching job details:", error));
        }

        function closeJobModal() {
            document.getElementById("jobModal").style.display = "none";
        }
    </script>

    <!-- CSS for Modal -->
    <style>
    /* Modal Base Styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(8px);
    z-index: 1000;
    animation: fadeIn 0.2s ease-out;
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #ffffff;
    margin: 8vh auto;
    padding: 2.5rem;
    width: 90%;
    max-width: 560px;
    border-radius: 16px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    animation: slideUp 0.3s ease-out;
}

/* Close Button */
.close {
    position: absolute;
    right: 1.25rem;
    top: 1.25rem;
    font-size: 1.25rem;
    color: #9ca3af;
    cursor: pointer;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s ease;
    background-color: #f3f4f6;
}

.close:hover {
    background-color: #e5e7eb;
    color: #1f2937;
}

/* Modal Title */
#modal-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: #0F4C3A;
    margin-bottom: 2rem;
    padding-right: 2rem;
    letter-spacing: -0.025em;
}

/* Modal Content Styling */
.modal-content p {
    display: grid;
    grid-template-columns: 140px 1fr;
    gap: 0.5rem;
    align-items: baseline;
    margin-bottom: 1.25rem;
    line-height: 1.6;
}

.modal-content strong {
    color: #374151;
    font-weight: 500;
    font-size: 0.95rem;
}

.modal-content span {
    color: #4b5563;
    font-size: 0.95rem;
}

/* Apply Button */
#apply-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-top: 2rem;
    padding: 0.875rem 2rem;
    background-color: #0F4C3A;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    border: 1px solid transparent;
    width: 100%;
}

#apply-link:hover {
    background-color: #176c52;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

#apply-link:active {
    transform: translateY(0);
    box-shadow: none;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from {
        transform: translateY(30px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Responsive Design */
@media (max-width: 640px) {
    .modal-content {
        margin: 0;
        width: 100%;
        height: 100%;
        border-radius: 0;
        padding: 1.75rem;
        display: flex;
        flex-direction: column;
    }
    
    #modal-title {
        font-size: 1.5rem;
        margin-bottom: 1.75rem;
    }
    
    .modal-content p {
        grid-template-columns: 120px 1fr;
        margin-bottom: 1rem;
    }
    
    .close {
        right: 1rem;
        top: 1rem;
    }
    
    #apply-link {
        margin-top: auto;
        margin-bottom: 1rem;
    }
}

    </style>

</body>
</html>
