<?php
include 'db.php';

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
    :root {
        --color-bg: #f8f9fa;
        --color-text: #333;
        --color-primary: #0B4D2E;
        --color-secondary: #6c757d;
        --color-accepted: #28a745;
        --color-rejected: #dc3545;
        --color-pending: #ffc107;
    }

    body {
        font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        background-color: var(--color-bg);
        color: var(--color-text);
        margin: 0;
        padding: 20px;
        line-height: 1.6;
    }

    h2 {
        color: var(--color-primary);
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 24px;
        text-align: center;
    }

    table {
        width: 100%;
        max-width: 1000px;
        margin: 24px auto;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    th, td {
        padding: 16px 20px;
        text-align: left;
    }

    th {
        background-color: var(--color-bg);
        color: var(--color-secondary);
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }

    tr:not(:last-child) {
        border-bottom: 1px solid #f0f0f0;
    }

    td:first-child {
        font-weight: 500;
        color: var(--color-primary);
    }

    td:nth-child(2) {
        font-weight: 500;
    }

    td:nth-child(3) {
        color: var(--color-secondary);
    }

    .status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 500;
        text-transform: capitalize;
    }

    .status-accepted { background-color: rgba(40, 167, 69, 0.1); color: var(--color-accepted); }
    .status-rejected { background-color: rgba(220, 53, 69, 0.1); color: var(--color-rejected); }
    .status-pending { background-color: rgba(255, 193, 7, 0.1); color: var(--color-pending); }

    td:nth-child(5) {
        color: var(--color-secondary);
        font-size: 0.875rem;
    }

    p {
        color: var(--color-secondary);
        text-align: center;
        padding: 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        max-width: 600px;
        margin: 20px auto;
    }
    </style>
</head>
<body>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $applicant_name = "%" . $_POST['applicant_name'] . "%"; // Using wildcards for partial matching

    $query = "SELECT a.app_full_name, j.title, j.company, a.status, a.applied_date 
              FROM applications a
              JOIN jobs j ON a.job_id = j.job_id
              WHERE a.app_full_name LIKE ? 
              ORDER BY a.applied_date DESC";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $applicant_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Search Results</h2>";
        echo "<table>
                <tr>
                    <th>Applicant Name</th>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Status</th>
                    <th>Applied Date</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            $status_class = 'status status-' . strtolower($row['status']);
            echo "<tr>
                    <td>{$row['app_full_name']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['company']}</td>
                    <td><span class='$status_class'>{$row['status']}</span></td>
                    <td>{$row['applied_date']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No applications found for the given name.</p>";
    }
}

echo '</body></html>';
?>