<?php
require_once '../includes/init.php';
require_once '../classes/Course.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$courseId = $_GET['id'] ?? null;

if (!$courseId) {
    echo "Invalid course ID.";
    exit();
}

$course = new Course();
$courseDetails = $course->getCourseById($courseId);
$coursetags = $course->getTagsByCourseId($courseId);

if (!$courseDetails) {
    echo "Course not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($courseDetails['title']); ?> - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/view_course.css">



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

    <section class="course-details" style="margin-top: 100px;">
        <h1><?php echo htmlspecialchars($courseDetails['title']); ?></h1>
        <div class="course-content">
            <!-- <iframe width="100%" height="500" src="<?php echo htmlspecialchars($courseDetails['youtube_link']); ?>" frameborder="0" allowfullscreen></iframe> -->
            <p align="center"><iframe width="800" height="500" src="<?php echo htmlspecialchars($courseDetails['youtube_link']); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></p>

            <p><?php echo nl2br(htmlspecialchars($courseDetails['content'])); ?></p>
            <h3>Tags:</h3>
        <?php if (!empty($coursetags)): ?>
            <?php foreach ($coursetags as $tag): ?>
                <span class="tag"><?php echo htmlspecialchars($tag['name']); ?></span>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tags available.</p>
        <?php endif; ?>
        </div>
    </section>

    <footer class="footer-container">
        <p>&copy; 2025 Youdemy. All rights reserved.</p>
    </footer>
</body>
</html>