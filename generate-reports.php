<?php
require_once('DBconnect.php');

$type = isset($_GET['type']) ? $_GET['type'] : 'all';
if ($type === 'bug') {
    $sql = "SELECT * FROM report WHERE type = 'Bug' ORDER BY timestamp DESC";
} elseif ($type === 'violation') {
    $sql = "SELECT * FROM report WHERE type = 'Violation' ORDER BY timestamp DESC";
} else {
    $sql = "SELECT * FROM report ORDER BY submitted_at ASC";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error retrieving reports: " . mysqli_error($conn);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        header {
            background-color: #333;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #4CAF50;
            padding: 0.8rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            margin: 0 10px;
            font-size: 1rem;
        }
        nav a:hover {
            background-color: #45a049;
        }
        .container {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <h1>User Reports</h1>
    </header>
    
    <div class="container">
        <h2>Reports</h2>
        <table>
            <tr>
                <th>Report ID</th>
                <th>User ID</th>
                <th>Report Type</th>
                <th>Description</th>
                <th>Timestamp</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['report_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['submitted_at']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No reports found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>