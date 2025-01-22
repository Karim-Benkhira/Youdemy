<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/User.php';
require_once '../classes/Student.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$student = new Student();
$student->setId($_SESSION['user_id']);


$courses = $student->getDashboard();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/student-dashboard.css">
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <a href="../index.php" class="logo">
                <img src="../assets/images/logo.svg" alt="Youdemy Logo">
                <span>Youdemy</span>
            </a>
            <div class="nav-links">
                <a href="student-dashboard.php">Dashboard</a>
                <a href="Student_catalog.php">All Course</a>
                <a href="my_courses.php">My Courses</a>
                <a href="student-teachers.php">Teachers</a>
                <a href="about.php">About</a>
                <a href="../includes/logout.php">Logout</a>
            </div>
        </div>
    </nav>


    <section class="dashboard">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1>
        <div class="stats">
            <div class="stat-card">
                <h3>Total Courses Enrolled</h3>
                <p class="stat-number"><?php echo count($courses); ?></p>
            </div>
            <div class="stat-card">
                
                <h3>Completed Courses</h3>
                <p class="stat-number"><?php echo count(array_filter($courses, fn($course) => $course['status'] === 'completed')); ?></p>
            </div>
            <div class="stat-card">
                <h3>Pending Courses</h3>
                <p class="stat-number"><?php echo count(array_filter($courses, fn($course) => $course['status'] === 'pending')); ?></p>
            </div>
        </div>

        <h2>Your Courses</h2>
        <div class="courses-grid">
            <?php foreach ($courses as $course): ?>
                <div class="course-card">
                    <h3><?php echo htmlspecialchars($course['title']); ?></h3>
                    <p>Status: <?php echo htmlspecialchars(ucfirst($course['status'])); ?></p>
                    <a href="../courses/view.php?id=<?php echo $course['id']; ?>" class="btn btn-primary">View Course</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>


    <footer class="footer">
        <div class="footer-container">
            <p>&copy; 2025 Youdemy. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>