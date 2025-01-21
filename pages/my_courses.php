<?php
require_once '../includes/init.php';
require_once '../classes/Student.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$student = new Student();
$student->setId($_SESSION['user_id']);
$courses = $student->getEnrolledCourses($_SESSION['user_id']); // استخدام دالة getEnrolledCourses من كلاس Student

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/my-courses.css">
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">
                <img src="../assets/images/logo.svg" alt="Youdemy Logo">
                <span>Youdemy</span>
            </a>
            <div class="nav-links">
                <a href="student-dashboard.php">Dashboard</a>
                <a href="Student_catalog.php">All Course</a>
                <a href="teachers.php">Teachers</a>
                <a href="about.php">About</a>
            </div>
        </div>
    </nav>


    <section class="my-courses">
        <h1>My Courses</h1>
        <div class="courses-grid">

            <div class="course-card">
                <img src="../assets/images/courses/course1.jpg" alt="Course 1" class="course-image">
                <h3 class="course-title">Web Development Bootcamp</h3>
                <p class="course-instructor">by John Doe</p>
                <form method="POST" action="">
                    <button type="submit" class="btn btn-primary">View Course</button>
                </form>
            </div>

            <div class="course-card">
                <img src="../assets/images/courses/course1.jpg" alt="Course 1" class="course-image">
                <h3 class="course-title">Web Development Bootcamp</h3>
                <p class="course-instructor">by John Doe</p>
                <form method="POST" action="">
                    <button type="submit" class="btn btn-primary">View Course</button>
                </form>
            </div>
            <div class="course-card">
                <img src="../assets/images/courses/course1.jpg" alt="Course 1" class="course-image">
                <h3 class="course-title">Web Development Bootcamp</h3>
                <p class="course-instructor">by John Doe</p>
                <form method="POST" action="">
                    <button type="submit" class="btn btn-primary">View Course</button>
                </form>
            </div>
            <?php foreach ($courses as $course): ?>
                    <div class="course-card">
                        <img src="<?php echo htmlspecialchars($course['image']); ?>" alt="<?php echo htmlspecialchars($course['title']); ?>" class="course-image">
                        <h3 class="course-title"><?php echo htmlspecialchars($course['title']); ?></h3>
                        <p class="course-instructor">by <?php echo htmlspecialchars($course['teacher_name']); ?></p>
                        <form method="POST" action="">
                        <button href="course-details.php?id=<?php echo $course['id']; ?>" class="btn btn-primary">View Details</button>
                        </form>
                    </div>
            <?php endforeach; ?>
            
        </div>
    </section>

</body>
</html>