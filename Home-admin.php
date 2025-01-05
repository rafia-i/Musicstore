<?php
session_start();
if (isset($_SESSION['ID'])) {
    $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');

$userQuery = "SELECT COUNT(*) AS total_users FROM customer";
$userResult = mysqli_query($conn, $userQuery);
$totalUsers = 0;
if ($userResult && mysqli_num_rows($userResult) > 0) {
    $userRow = mysqli_fetch_assoc($userResult);
    $totalUsers = $userRow['total_users'];
}

$songQuery = "SELECT COUNT(*) AS total_songs FROM tracks";
$songResult = mysqli_query($conn, $songQuery);
$totalSongs = 0;
if ($songResult && mysqli_num_rows($songResult) > 0) {
    $songRow = mysqli_fetch_assoc($songResult);
    $totalSongs = $songRow['total_songs'];
}

$revenueQuery = "SELECT SUM(totalprice) AS total_revenue FROM invoice";
$revenueResult = mysqli_query($conn, $revenueQuery);
$totalRevenue = 0;
if ($revenueResult && mysqli_num_rows($revenueResult) > 0) {
    $revenueRow = mysqli_fetch_assoc($revenueResult);
    $totalRevenue = $revenueRow['total_revenue'];
}

$adminQuery = "SELECT * FROM admin WHERE ID=$ID"; 
$adminResult = mysqli_query($conn, $adminQuery);
$adminDetails = null;
if ($adminResult && mysqli_num_rows($adminResult) > 0) {
    $adminDetails = mysqli_fetch_assoc($adminResult);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
        }

        nav {
            display: flex;
            justify-content: space-around;
            background-color: #333;
            color: white;
            padding: 0.5rem 0;
        }

        nav a {
            text-decoration: none;
            color: white;
            font-size: 1.1rem;
            padding: 0.5rem;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #4CAF50;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
        }

        .section {
            margin-bottom: 2rem;
        }

        .section h2 {
            font-size: 1.5rem;
            color: #4CAF50;
            margin-bottom: 1rem;
        }

        .transactions {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 2rem;
        }

        .transactions th, .transactions td {
            border: 1px solid #ddd;
            padding: 0.8rem;
        }

        .transactions th {
            background-color: #4CAF50;
            color: white;
            text-align: left;
        }

        .transactions tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .transactions tr:hover {
            background-color: #ddd;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 0.8rem 1rem;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        footer {
            text-align: center;
            padding: 1rem 0;
            background-color: #333;
            color: white;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <nav>
        <a href="#Account">Home</a>
        <a href="addTracks.php">Add Tracks</a>
        <a href="addArtist.php">Add Artist</a>
        <a href="updatePrice.php">Update Price</a>
    </nav>

    <div class="container">
        <section id="account-details" class="section">
            <h2>Account Details</h2>
            <?php if ($adminDetails): ?>
                <table class="transactions">
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                    <tr>
                        <td>Admin ID</td>
                        <td><?php echo htmlspecialchars($adminDetails['ID']); ?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><?php echo htmlspecialchars($adminDetails['name']); ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo htmlspecialchars($adminDetails['email']); ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?php echo htmlspecialchars($adminDetails['phone']); ?></td>
                    </tr>
                </table>
            <?php else: ?>
                <p>Unable to retrieve admin details. Please Contact with your Engineers.</p>
            <?php endif; ?>
        </section>

        <section class="overview">
            <h2>Overview</h2>
            <p>Welcome back, Admin! Here are some quick stats:</p>
            <div class="card">
                <ul>
                    <li>Total Users: <strong><?php echo $totalUsers; ?></strong></li>
                    <li>Total Songs in Tracks: <strong><?php echo $totalSongs; ?></strong></li>
                    <li>Total Revenue: <strong><?php echo number_format($totalRevenue, 2); ?></strong></li>
                </ul>
            </div>
        </section>

        <section id="transactions" class="section">
            <h2>Transactions Of customers</h2>
            <div class="dropdown">
                <button>View Transactions</button>
                <div class="dropdown-content">
                    <a href="24-transactions.php">Last 24 Hours</a>
                    <a href="week-transactions.php">Last Week</a>
                    <a href="All.php">All</a>
                </div>
            </div>
        </section>

        <section id="manage-users" class="section">
            <h2>Manage Users</h2>
            <p>View, edit, or remove users from the platform. <a href="manage-users.php">Go to User Management</a></p>
            <form method="POST" action="user_report.php">
                <button type="submit" name="user_activity_report">Download User Activity Report</button>
            </form>
        </section>

<section id="reports" class="section">
    <h2>View Reports of Customers</h2>
    <form method="GET" action="">
        <label for="report_type">Choose a report type:</label>
        <select name="report_type" id="report_type">
            <option value="all" <?php echo (isset($_GET['report_type']) && $_GET['report_type'] == 'all') ? 'selected' : ''; ?>>View All</option>
            <option value="Bug" <?php echo (isset($_GET['report_type']) && $_GET['report_type'] == 'Bug') ? 'selected' : ''; ?>>Bug Reports</option>
            <option value="Violation" <?php echo (isset($_GET['report_type']) && $_GET['report_type'] == 'Violation') ? 'selected' : ''; ?>>Inappropriate contents Reports</option>
        </select>
        <button type="submit">Go</button>
    </form>

    <?php
    $result1 = false;
    $result2 = false;
    $result3 = false;
    if (isset($_GET['report_type'])) {
        $reportType = $_GET['report_type'];
        if ($reportType === "Bug") {
            $sql = "SELECT * FROM report WHERE type = 'Bug'";
            $result1 = mysqli_query($conn, $sql);
        } elseif ($reportType === "Violation") {
            $sql = "SELECT * FROM report WHERE type = 'Inappropriate_content'";
            $result2 = mysqli_query($conn, $sql);
        }else {
        $sql = "SELECT * FROM report ORDER BY submitted_at DESC";
        $result3 = mysqli_query($conn, $sql);
        }

        

        if ($result1 && mysqli_num_rows($result1) > 0) {
            echo "<table class='transactions'>";
            echo "<tr>
                    <th>Report ID</th>
                    <th>User ID</th>
                    <th>Report Type</th>
                    <th>Description</th>
                    <th>Date</th>
                  </tr>";
            while ($row = mysqli_fetch_assoc($result1)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['report_id']) . "</td>
                        <td>" . htmlspecialchars($row['user_id']) . "</td>
                        <td>" . htmlspecialchars($row['type']) . "</td>
                        <td>" . htmlspecialchars($row['description']) . "</td>
                        <td>" . htmlspecialchars($row['submitted_at']) . "</td>
                      </tr>";
        
            }
            echo "</table>";
        
        } elseif ($result2 && mysqli_num_rows($result2) > 0) {
            echo "<table class='transactions'>";
            echo "<tr>
                    <th>Report ID</th>
                    <th>User ID</th>
                    <th>Report Type</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Track_id</th>

                  </tr>";
            while ($row = mysqli_fetch_assoc($result2)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['report_id']) . "</td>
                        <td>" . htmlspecialchars($row['user_id']) . "</td>
                        <td>" . htmlspecialchars($row['type']) . "</td>
                        <td>" . htmlspecialchars($row['description']) . "</td>
                        <td>" . htmlspecialchars($row['submitted_at']) . "</td>
                        <td>" . htmlspecialchars($row['track_id']) . "</td>
                      </tr>";
        
            }
            echo "</table>";
        } elseif ($result3 && mysqli_num_rows($result3) > 0) {
            echo "<table class='transactions'>";
            echo "<tr>
                    <th>Report ID</th>
                    <th>User ID</th>
                    <th>Report Type</th>
                    <th>Description</th>
                    <th>Date</th>
                  </tr>";
            while ($row = mysqli_fetch_assoc($result3)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['report_id']) . "</td>
                        <td>" . htmlspecialchars($row['user_id']) . "</td>
                        <td>" . htmlspecialchars($row['type']) . "</td>
                        <td>" . htmlspecialchars($row['description']) . "</td>
                        <td>" . htmlspecialchars($row['submitted_at']) . "</td>
                      </tr>";
        
            }
            echo "</table>";
        } else {
            echo "<p>No reports found for the selected type.</p>";
        }
        
    } else {
        echo "<p>Select a report type to view reports.</p>";
    }
    
    ?>
</section>

        

        <section id="settings" class="section">
            <h2>Settings</h2>
            <p>Update admin account settings, configure platform preferences, and more. <a href="settings.php">Go to Settings</a></p>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 MusicStore. All rights reserved.</p>
    </footer>
</body>
</html>
