<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/add-course.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">
                <img src="../assets/images/logo.svg" alt="Youdemy Logo">
                <span>Youdemy</span>
            </a>
            <div class="nav-links">
                <a href="catalog.php">Courses</a>
                <a href="categories.php">Categories</a>
                <a href="teachers.php">Teachers</a>
                <a href="about.php">About</a>
            </div>
            <div class="nav-buttons">
                <a href="login.php" class="nav-btn btn-login">Login</a>
                <a href="register.php" class="nav-btn btn-register">Get Started</a>
            </div>
        </div>
    </nav>

    <section class="add-course">
        <h1>Add New Course</h1>
        <form id="add-course-form">
            <input type="text" placeholder="Course Title" required>
            <textarea placeholder="Course Description" required></textarea>
            <input type="text" placeholder="Instructor Name" required>
            <input type="text" placeholder="Tags (comma separated)" required>
            <input type="file" accept="video/*, .pdf" required>
            <button type="submit">Add Course</button>
        </form>
    </section>
</body>
</html>