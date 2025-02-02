<?php
session_start();
include 'db.php';

// Get the logged-in employer's ID
$empid = $_SESSION['empid'];

// Fetch applications only for jobs posted by this employer
$sql = "SELECT a.application_id, a.app_full_name, a.app_email, a.app_phone, 
               a.app_linkedin_link, a.app_github_link, a.app_cv_file, a.status, a.applied_date,
               j.title AS job_title
        FROM applications a
        JOIN jobs j ON a.job_id = j.job_id
        WHERE j.empid = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $empid);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Applications - Employer Dashboard</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
    <section id="applications">
        <h2 style="font-family: 'Inter', -apple-system; color:#0b4d2c; font-size: 1.75rem; font-weight: 700; letter-spacing: -0.5px;">Job Applications</h2>
        <table>
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Applicant Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>LinkedIn</th>
                    <th>GitHub</th>
                    <th>CV</th>
                    <th>Status</th>
                    <th>Applied Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['job_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['app_full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['app_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['app_phone']); ?></td>
                        <td>
                            <?php if (!empty($row['app_linkedin_link'])) { ?>
                                <a href="<?php echo htmlspecialchars($row['app_linkedin_link']); ?>" target="_blank">LinkedIn</a>
                            <?php } else { echo "N/A"; } ?>
                        </td>
                        <td>
                            <?php if (!empty($row['app_github_link'])) { ?>
                                <a href="<?php echo htmlspecialchars($row['app_github_link']); ?>" target="_blank">GitHub</a>
                            <?php } else { echo "N/A"; } ?>
                        </td>
                        <td>
                            <?php if (!empty($row['app_cv_file'])) { ?>
                                <a href="<?php echo htmlspecialchars($row['app_cv_file']); ?>" download>Download CV</a>
                            <?php } else { echo "N/A"; } ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td><?php echo htmlspecialchars($row['applied_date']); ?></td>

                        <td>
                <button style="background-color: #0B442D; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;" class="btn-accept" onclick="updateStatus(<?php echo $row['application_id']; ?>, 'Accepted')">Accept</button>
                <button style="background-color: #dc2626;; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;" class="btn-reject" onclick="updateStatus(<?php echo $row['application_id']; ?>, 'Rejected')">Reject</button>
            </td>
                    </tr>

                    <script>
function updateStatus(applicationId, newStatus) {
    if (!confirm("Are you sure you want to " + newStatus.toLowerCase() + " this application?")) {
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText.trim() === "success") {
                document.getElementById("status-" + applicationId).innerText = newStatus;
            } else {
                alert("Failed to update status.");
            }
        }
    };

    xhr.send("application_id=" + applicationId + "&status=" + newStatus);
}
</script>
                <?php } ?>
            </tbody>
        </table>
    </section>
</body>
</html>
