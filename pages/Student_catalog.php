<?php
require_once '../includes/process_Student_catalog.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Catalog - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/catalog.css">
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
                <a href="my_courses.php">My Courses</a>
                <a href="teachers.php">Teachers</a>
                <a href="about.php">About</a>
                <a href="../includes/logout.php">Logout</a>
            </div>
        </div>
    </nav>


    <section class="course-catalog">
        <h1>Course Catalog</h1>
        <div class="search-bar">
            <input type="text" placeholder="Search for courses..." id="search-input">
            <button id="search-button">Search</button>
        </div>
        <div class="courses-grid">

            <div class="course-card">
                <img src="../assets/images/courses/course1.jpg" alt="Course 1" class="course-image">
                <h3 class="course-title">Web Development Bootcamp</h3>
                <p class="course-instructor">by John Doe</p>
                <form method="POST" action="">
                    <button type="submit" class="btn btn-primary">Subscription</button>
                    <button type="submit" class="btn btn-primary">View Details</button>
                </form>
            </div>

            <div class="course-card">
                <img src="../assets/images/courses/course1.jpg" alt="Course 1" class="course-image">
                <h3 class="course-title">Web Development Bootcamp</h3>
                <p class="course-instructor">by John Doe</p>
                <form method="POST" action="">
                    <button type="submit" class="btn btn-primary">Subscription</button>
                    <button type="submit" class="btn btn-primary">View Details</button>
                </form>
            </div>

            <div class="course-card">
                <img src="../assets/images/courses/course1.jpg" alt="Course 1" class="course-image">
                <h3 class="course-title">Web Development Bootcamp</h3>
                <p class="course-instructor">by John Doe</p>
                <form method="POST" action="">
                    <button type="submit" class="btn btn-primary">Subscription</button>
                    <button type="submit" class="btn btn-primary">View Details</button>
                </form>
            </div>

            <?php foreach ($courses as $course): ?>
                <div class="course-card">
                    <img src="<?php echo htmlspecialchars($course['image']); ?>" alt="<?php echo htmlspecialchars($course['title']); ?>" class="course-image">
                    <h3 class="course-title"><?php echo htmlspecialchars($course['title']); ?></h3>
                    <p class="course-instructor">by <?php echo htmlspecialchars($course['teacher_name']); ?></p>
                    <form method="POST" action="">
                    <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                    <button type="submit" class="btn btn-primary">Subscription</button>
                    <button type="submit" class="btn btn-primary">View Details</button>
                    </form>
                </div>
            <?php endforeach; ?>
            
            
           
        </div>
    </section>

</body>
</html>