<?php
require_once '../includes/init.php';
require_once '../classes/Course.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header('Location: ../login.php');
    exit();
}

$course = new Course();
$courses = $course->getAllCoursesByTeacher($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/teacher-dashboard.css">
    <style>
        body {
            background-color: var(--primary-bg);
            font-family: Arial, sans-serif;
        }

        .course-container {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--purple-light);
        }

        th {
            background-color: var(--purple-primary);
            color: var(--text-primary);
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .button {
            background: var(--purple-primary);
            color: var(--text-primary);
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .button:hover {
            background: var(--pink-accent);
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="admin-sidebar">
            <h2>Youdemy</h2>
            <nav>
                <ul>
                    <li><a href="teacher-dashboard.php">Dashboard</a></li>
                    <li><a href="add-course.php">Add Course</a></li>
                    <li><a href="manage-course.php" class="active">Manage Courses</a></li>
                    <li><a href="../includes/logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main class="admin-main">
            <header class="dashboard-header">
                <h1>Manage Your Courses</h1>
            </header>

            <div class="course-container">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($course['title']); ?></td>
                                <td><?php echo htmlspecialchars($course['description']); ?></td>
                                <td><?php echo htmlspecialchars($course['category_name']); ?></td>
                                <td><?php echo htmlspecialchars($course['status']); ?></td>
                                <td>
                                    <a href="edit-course.php?id=<?php echo $course['id']; ?>" class="button">Edit</a>
                                    <a href="delete-course.php?id=<?php echo $course['id']; ?>" class="button">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>