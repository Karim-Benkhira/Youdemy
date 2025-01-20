<?php
require_once '../includes/init.php';
require_once '../classes/Admin.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$admin = new Admin();
$stats = $admin->getDashboard();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Statistics - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/admin-dashboard.css">
    <link rel="stylesheet" href="../assets/css/admin-statistics.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <img src="../assets/images/logo.svg" alt="Youdemy Logo">
                <h2>Youdemy</h2>
            </div>
            <nav>
                <ul>
                    <li><a href="admin-dashboard.php">Dashboard</a></li>
                    <li><a href="manage-users.php">Manage Users</a></li>
                    <li><a href="manage-courses.php">Manage Courses</a></li>
                    <li><a href="manage-categories.php">Manage Categories</a></li>
                    <li><a href="admin-statistics.php" class="active">Statistics</a></li>
                    <li><a href="../includes/logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main class="admin-main">
            <h1>Admin Statistics</h1>
            <div class="stats-container">
                <div class="stat-item">
                    <h2>Total Users</h2>
                    <p><?php echo $stats['total_users']; ?></p>
                </div>
                <div class="stat-item">
                    <h2>Total Courses</h2>
                    <p><?php echo $stats['total_courses']; ?></p>
                </div>
                <div class="stat-item">
                    <h2>Pending Teachers</h2>
                    <p><?php echo $stats['pending_teachers']; ?></p>
                </div>
                <div class="stat-item">
                    <h2>Top Courses</h2>
                    <p><?php echo count($stats['top_courses']); ?></p>
                </div>
                <div class="stat-item">
                    <h2>Categories Stats</h2>
                    <p><?php echo count($stats['categories_stats']); ?></p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>