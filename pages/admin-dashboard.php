<?php
require_once '../includes/init.php';
require_once '../classes/Admin.php';
require_once '../includes/process_admin.php';

// session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$admin = new Admin();
$dashboardStats = $admin->getDashboard();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/admin-dashboard.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">
    <div class="admin-container">
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <img src="../assets/images/logo.svg" alt="Youdemy Logo">
                <h2>Youdemy</h2>
            </div>
            <nav class="admin-nav">
                <ul>
                    <li><a href="admin-dashboard.php" class="active">Dashboard</a></li>
                    <li><a href="manage-users.php">Manage Users</a></li>
                    <li><a href="admin-manage-courses.php">Manage Courses</a></li>
                    <li><a href="manage-categories.php">Manage Categories</a></li>
                    <li><a href="admin-statistics.php">Teacher Statistics</a></li>
                    <li><a href="../includes/logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main class="admin-main">
            <div class="admin-stats">
                <div class="admin-stat-card">
                    <h3>Total Users</h3>
                    <p id="totalUsers"><?php echo $dashboardStats['total_users']; ?></p>
                </div>
                <div class="admin-stat-card">
                    <h3>Total Courses</h3>
                    <p id="totalCourses"><?php echo $dashboardStats['total_courses']; ?></p>
                </div>
                <div class="admin-stat-card">
                    <h3>Pending Teachers</h3>
                    <p id="pendingTeachers"><?php echo $dashboardStats['pending_teachers']; ?></p>
                </div>

                <div class="admin-stat-card">
                    <h3>Courses per Teacher</h3>
                    <!-- <p id="coursesPerTeacher"><?php echo $dashboardStats['courses_per_teacher']; ?></p> -->
                </div>
                <div class="admin-stat-card">
                    <h3>Students per Course</h3>
                    <!-- <p id="studentsPerCourse"><?php echo $dashboardStats['students_per_course']; ?></p> -->
                </div>
                
            </div>
        </main>
    </div>

    <script>
        function updateDashboardStats() {
            fetch('../includes/process_admin.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=get_dashboard_stats'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('totalUsers').textContent = data.data.total_users;
                    document.getElementById('totalCourses').textContent = data.data.total_courses;
                    document.getElementById('pendingTeachers').textContent = data.data.pending_teachers;
                }
            })
            .catch(error => console.error('Error:', error));
        }

        setInterval(updateDashboardStats, 60000);
    </script>
</body>
</html>