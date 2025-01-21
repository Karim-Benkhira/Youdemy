<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Learn Anything, Anytime</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/hero.css">
    <link rel="stylesheet" href="../assets/css/categories.css">
    <link rel="stylesheet" href="../assets/css/featured-courses.css">
    <link rel="stylesheet" href="../assets/css/popular-teachers.css">
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
                <a href="#categories">Categories</a>
                <a href="#teachers">Teachers</a>
                <a href="#about">About</a>
            </div>

            <div class="nav-buttons">
                <a href="login.php" class="nav-btn btn-login">Login</a>
                <a href="register.php" class="nav-btn btn-register">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title">Learn New Skills Online with Top Educators</h1>
                <p class="hero-subtitle">
                    Join thousands of students from around the world learning together. 
                    Online learning is as easy and natural as chatting with a group of friends.
                </p>
                <div class="hero-buttons">
                    <a href="register.php" class="btn btn-primary">Start Learning Now</a>
                    <a href="#courses" class="btn btn-secondary">Browse Courses</a>
                </div>
            </div>
            
            <div class="hero-image">
                <img src="../assets/images/hero-image.png" alt="Learning Illustration">
                <div class="floating-cards card-1">
                    <div class="stat-card">
                        <div class="stat-icon">👨‍🎓</div>
                        <div class="stat-info">
                            <h4>1000+</h4>
                            <p>Active Students</p>
                        </div>
                    </div>
                </div>

                <div class="floating-cards card-2">
                    <div class="stat-card">
                        <div class="stat-icon">📚</div>
                        <div class="stat-info">
                            <h4>100+</h4>
                            <p>Courses</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



<section class="categories">
    <div class="section-header">
        <h2 class="section-title">Explore Top Categories</h2>
        <p class="section-subtitle">Discover our most popular course categories chosen by students worldwide</p>
    </div>

    <div class="categories-grid">
        <div class="category-card">
            <div class="category-icon">💻</div>
            <h3 class="category-title">Programming</h3>
            <p class="category-count">150+ Courses</p>
        </div>

        <div class="category-card">
            <div class="category-icon">🎨</div>
            <h3 class="category-title">Design</h3>
            <p class="category-count">120+ Courses</p>
        </div>

        <div class="category-card">
            <div class="category-icon">📊</div>
            <h3 class="category-title">Business</h3>
            <p class="category-count">100+ Courses</p>
        </div>

        <div class="category-card">
            <div class="category-icon">📱</div>
            <h3 class="category-title">Mobile Dev</h3>
            <p class="category-count">80+ Courses</p>
        </div>

        <div class="category-card">
            <div class="category-icon">🔒</div>
            <h3 class="category-title">Cyber Security</h3>
            <p class="category-count">90+ Courses</p>
        </div>

        <div class="category-card">
            <div class="category-icon">🤖</div>
            <h3 class="category-title">AI & ML</h3>
            <p class="category-count">70+ Courses</p>
        </div>
    </div>
</section>


<section class="featured-courses">
    <div class="courses-header">
        <h2 class="courses-title">Featured Courses</h2>
        <p class="courses-subtitle">Explore our top-rated courses selected by students</p>
    </div>

    <div class="courses-grid">
        <div class="course-card">
            <img src="../assets/images/courses/course1.jpg" alt="Course 1" class="course-image">
            <h3 class="course-title">Web Development Bootcamp</h3>
            <p class="course-instructor">by John Doe</p>
        </div>

        <div class="course-card">
            <img src="../assets/images/courses/course2.jpg" alt="Course 2" class="course-image">
            <h3 class="course-title">SOC analyst</h3>
            <p class="course-instructor">by Jane Smith</p>
        </div>

        <div class="course-card">
            <img src="../assets/images/courses/course3.jpg" alt="Course 3" class="course-image">
            <h3 class="course-title">Data Science A-Z</h3>
            <p class="course-instructor">by Alex Johnson</p>
        </div>

        <div class="course-card">
            <img src="../assets/images/courses/course4.jpg" alt="Course 4" class="course-image">
            <h3 class="course-title">Digital Marketing Essentials</h3>
            <p class="course-instructor">by Emily Davis</p>
        </div>
    </div>
</section>


<section class="popular-teachers">
    <div class="teachers-header">
        <h2 class="teachers-title">Popular Teachers</h2>
        <p class="teachers-subtitle">Meet our top-rated instructors who are passionate about teaching</p>
    </div>

    <div class="teachers-grid">
        <div class="teacher-card">
            <img src="../assets/images/teachers/teacher1.jpeg" alt="Teacher 1" class="teacher-image">
            <h3 class="teacher-name">Naham Sec</h3>
            <p class="teacher-expertise">Cyber Security Expert</p>
        </div>

        <div class="teacher-card">
            <img src="../assets/images/teachers/teacher2.jpeg" alt="Teacher 2" class="teacher-image">
            <h3 class="teacher-name">Jane Smith</h3>
            <p class="teacher-expertise">Graphic Design Specialist</p>
        </div>

        <div class="teacher-card">
            <img src="../assets/images/teachers/teacher3.png" alt="Teacher 3" class="teacher-image">
            <h3 class="teacher-name">Karim Benkhira</h3>
            <p class="teacher-expertise">Red/Blue Team</p>
        </div>

        <div class="teacher-card">
            <img src="../assets/images/teachers/teacher4.jpeg" alt="Teacher 4" class="teacher-image">
            <h3 class="teacher-name">Yassine Aboukire</h3>
            <p class="teacher-expertise">Cybersecurity Researcher</p>
        </div>
    </div>
</section>
    
</body>
</html>