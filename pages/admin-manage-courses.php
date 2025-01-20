<?php
require_once '../includes/init.php';
require_once '../classes/Admin.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$admin = new Admin();
$courses = $admin->getAllCourses();


if (isset($_GET['delete'])) {
    $admin->deleteCourse($_GET['delete']);
    header('Location: admin-manage-courses.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/admin-dashboard.css">
    <link rel="stylesheet" href="../assets/css/admin-manage-courses.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <img src="../assets/images/logo.svg" alt="Youdemy Logo">
                <h2>Youdemy</h2>
            </div>
            <nav>
                <ul>
                    <li><a href="admin-dashboard.php">Dashboard</a></li>
                    <li><a href="manage-users.php">Manage Users</a></li>
                    <li><a href="admin-manage-courses.php" class="active">Manage Courses</a></li>
                    <li><a href="manage-categories.php">Manage Categories</a></li>
                    <li><a href="admin-statistics.php">Statistics</a></li>
                    <li><a href="../includes/logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main class="admin-main">
            <h1>Manage Courses</h1>

            <div class="courses-table">
                <table>
                    <thead>
                        <tr>
                            <th>Course Title</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course): ?>
                            <tr>
                                <td><?php echo $course['title']; ?></td>
                                <td><?php echo $course['description']; ?></td>
                                <td>
                                    <a href="?delete=<?php echo $course['id']; ?>">Delete</a>
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