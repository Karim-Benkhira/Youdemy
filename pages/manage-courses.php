<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/manage-courses.css">
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


    <section class="manage-courses">
        <div class="manage-header">
            <h1>Manage Your Courses</h1>
            <a href="add-course.php" class="btn-add">Add New Course</a>
        </div>
        
        <div class="courses-table">
            <table>
                <thead>
                    <tr>
                        <th>Course Title</th>
                        <th>Students</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Web Development Bootcamp</td>
                        <td>150</td>
                        <td><span class="status active">Active</span></td>
                        <td class="actions">
                            <button class="btn-edit">Edit</button>
                            <button class="btn-delete">Delete</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </section>

</body>
</html>