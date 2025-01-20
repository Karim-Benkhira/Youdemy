<?php
require_once '../includes/init.php'; // تأكد من وجود ملف التهيئة
require_once '../classes/Teacher.php'; // تأكد من وجود كلاس Teacher
require_once '../classes/Course.php'; // تأكد من وجود كلاس Course

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header('Location: ../login.php');
    exit();
}

$teacher = new Teacher();
$teacherId = $_SESSION['user_id'];

// جلب الفئات والوسوم
$categories = $teacher->getCategories();
$tags = $teacher->getTags(); // جلب جميع الوسوم من قاعدة البيانات

// معالجة نموذج إضافة الدورة
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'title' => $_POST['title'] ?? '',
        'description' => $_POST['description'] ?? '',
        'youtube_link' => $_POST['youtube_link'] ?? '',
        'content' => $_POST['content'] ?? '', // إضافة الشرح النصي
        'teacher_id' => $_SESSION['user_id'] ?? '',
        'category' => $_POST['category'] ?? '',
        'tags' => $_POST['tags'] ?? []
    ];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imagePath = '../assets/images/courses/image_uploads/' . $imageName; // تأكد من تحديد المسار الصحيح
        move_uploaded_file($imageTmpName, $imagePath);
        $data['image'] = $imageName; // تخزين اسم الصورة
    }

    $course = new Course();
    if ($course->create($data)) {
        header('Location: teacher-dashboard.php'); // إعادة توجيه بعد الإضافة
        exit();
    } else {
        $error = "Failed to add course.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course - Youdemy</title>
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
    <link rel="stylesheet" href="../assets/css/teacher-dashboard.css">
    <link rel="stylesheet" href="../assets/css/add-course.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
</head>
<body>
    <div class="dashboard-container">
        <aside class="admin-sidebar">
            <h2>Youdemy</h2>
            <nav>
                <ul>
                    <li><a href="teacher-dashboard.php">Dashboard</a></li>
                    <li><a href="add-course.php" class="active">Add Course</a></li>
                    <li><a href="manage-courses.php">Manage Courses</a></li>
                    <li><a href="../includes/logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main class="admin-main">
            <header class="dashboard-header">
                <img src="../assets/images/logo.svg" alt="Youdemy Logo" class="logo">
                <h1>Add New Course</h1>
            </header>

            <?php if (isset($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <div class="form-container">
                <form action="add-course.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="title" placeholder="Course Title" required>
                    <textarea name="description" placeholder="Course Description" required></textarea>
                    <input type="text" name="youtube_link" placeholder="YouTube Video Link" required>
                    <input type="file" name="image" accept="image/*" required>
                    <textarea name="content" placeholder="Content" required></textarea>
                    
                    <label for="tags">Select Tags:</label>
                    <select id="tag-select" name="tags[]" multiple required>
                        <?php foreach ($tags as $tag): ?>
                            <option value="<?php echo htmlspecialchars($tag['id']); ?>"><?php echo htmlspecialchars($tag['name']); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="category">Select Category:</label>
                    <select name="category" id="category" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category['id']); ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <button type="submit">Add New Course</button>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        const tagSelect = document.getElementById('tag-select');
        const choices = new Choices(tagSelect, {
            removeItemButton: true,
            searchEnabled: true,
            placeholder: true,
            placeholderValue: 'Select tags...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices to choose from',
        });
    </script>
</body>
</html>