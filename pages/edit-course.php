<?php
require_once '../includes/init.php';
require_once '../classes/Course.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header('Location: ../login.php');
    exit();
}

$course = new Course();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'id' => $_POST['id'],
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'youtube_link' => $_POST['youtube_link'],
        'image' => $_POST['image'],
        'content' => $_POST['content'],
        'category' => $_POST['category'],
        'tags' => $_POST['tags'] ?? []
    ];


    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/images/courses/image_upload/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {

            $data['image'] = $uploadFile;
        } else {

            echo "Error uploading the file.";
        }
    } else {

        echo "No file uploaded or there was an upload error.";
    }


    if ($course->update($data)) {
        header('Location: manage-courses.php');
        exit();
    } else {
        $error = "Failed to update course.";
    }
} else {

    $course_id = $_GET['id'] ?? null;
    if ($course_id) {
        $courseData = $course->getCourseById($course_id);
        $tags = $course->getAllTags();
        $categories = $course->getAllCategories();
    } else {
        header('Location: manage-courses.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course - Youdemy</title>
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
                <h1>Edit Course</h1>
            </header>

            <?php if (isset($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <div class="form-container">
                <form action="edit-course.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($courseData['id']); ?>">
                    <input type="text" name="title" value="<?php echo htmlspecialchars($courseData['title']); ?>" required>
                    <textarea name="description" required><?php echo htmlspecialchars($courseData['description']); ?></textarea>
                    <input type="text" name="youtube_link" placeholder="YouTube Video Link" value="<?php echo htmlspecialchars($courseData['youtube_link']); ?>" required>
                    <input type="file" name="image" accept="image/*" required>
                    <textarea name="content" placeholder="Content" required><?php echo htmlspecialchars($courseData['content']); ?></textarea>
                    
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
                    
                    <button type="submit">Update Course</button>
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