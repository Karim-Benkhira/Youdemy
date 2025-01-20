<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll in Course - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Enroll in a Course</h1>
    <form method="POST" action="../includes/enroll_course.php">
        <select name="course_id" required>
            <option value="">Select a Course</option>
            <?php
            $courses = $student->getAvailableCourses();
            foreach ($courses as $course) {
                echo "<option value='{$course['id']}'>{$course['title']}</option>";
            }
            ?>
        </select>
        <button type="submit">Enroll</button>
    </form>
</body>
</html>