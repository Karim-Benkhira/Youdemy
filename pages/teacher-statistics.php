<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Statistics - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/teacher-statistics.css">
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


    <section class="statistics">
        <h1>Your Statistics</h1>
        

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Students</h3>
                <p class="stat-number">1,234</p>
                <span class="trend positive">+12% this month</span>
            </div>
            
            <div class="stat-card">
                <h3>Active Courses</h3>
                <p class="stat-number">15</p>
                <span class="trend positive">+2 new courses</span>
            </div>
            
            <div class="stat-card">
                <h3>Total Revenue</h3>
                <p class="stat-number">$12,345</p>
                <span class="trend positive">+15% this month</span>
            </div>
            
            <div class="stat-card">
                <h3>Average Rating</h3>
                <p class="stat-number">4.8</p>
                <span class="trend neutral">No change</span>
            </div>
        </div>


        <div class="chart-section">
            <h2>Most Popular Courses</h2>
            <div class="courses-chart">
                <div class="chart-bar">
                    <div class="bar" style="width: 90%;">Web Development</div>
                    <span>450 students</span>
                </div>
                <div class="chart-bar">
                    <div class="bar" style="width: 75%;">JavaScript Basics</div>
                    <span>375 students</span>
                </div>
                <div class="chart-bar">
                    <div class="bar" style="width: 60%;">Python for Beginners</div>
                    <span>300 students</span>
                </div>
            </div>
        </div>
    </section>

</body>
</html>