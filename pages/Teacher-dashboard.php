<?php
require_once '../includes/init.php';
require_once '../classes/Teacher.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header('Location: login.php');
    exit();
}

$teacher = new Teacher();
$teacherId = $_SESSION['user_id'];

$courses = $teacher->getDashboard();
$teacherInfo = $teacher->getTeacherInfo($teacherId);
$totalCourses = $teacher->getTotalCourses(); 
$totalStudents = array_sum(array_column($courses, 'student_count'));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/teacher-dashboard.css">

</head>
<body>
    <div class="dashboard-container">
        <aside class="admin-sidebar">
        <div class="admin-logo">
                <img src="../assets/images/logo.svg" alt="Youdemy Logo">
                <h2>Youdemy</h2>
        </div>
            <nav>
                <ul>
                    <li><a href="teacher-dashboard.php" class="active">Dashboard</a></li>
                    <li><a href="add-course.php">Add Course</a></li>
                    <li><a href="manage-courses.php">Manage Courses</a></li>
                    <li><a href="../includes/logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main class="admin-main">
            <header class="dashboard-header">
                <img src="../assets/images/logo.svg" alt="Youdemy Logo" class="logo">
                <h1>Welcome, <?php echo htmlspecialchars($teacherInfo['name'] ?? 'karim'); ?></h1>
                 <!-- <h1>welcome karim</h1> -->
            </header>

            <section class="dashboard-stats">
                <div class="stat-card">
                    <h3>Total Courses</h3>
                    <p><?php echo $totalCourses; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Total Students</h3>
                    <p><?php echo $totalStudents; ?></p>
                </div>
            </section>

            <section class="dashboard-courses">
                <h2>Your Courses</h2>
                <ul class="course-list">
                    <?php foreach ($courses as $course): ?>
                        <li>
                            <?php echo htmlspecialchars($course['title']); ?>
                            <a href="edit-course.php?id=<?php echo $course['id']; ?>" class="btn-edit">Edit</a>
                            <a href="delete-course.php?id=<?php echo $course['id']; ?>" class="btn-delete">Delete</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        </main>
    </div>
</body>
</html>