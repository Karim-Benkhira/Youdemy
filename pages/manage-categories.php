<?php
require_once '../includes/init.php';
require_once '../classes/Admin.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$admin = new Admin();
$categories = $admin->getAllCategories();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_category') {
    $name = $_POST['name'];
    $admin->addCategory($name);
    header('Location: manage-categories.php');
    exit();
}


if (isset($_GET['delete'])) {
    $admin->deleteCategory($_GET['delete']);
    header('Location: manage-categories.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/admin-dashboard.css">
    <link rel="stylesheet" href="../assets/css/manage-categories.css">
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
                    <li><a href="manage-courses.php">Manage Courses</a></li>
                    <li><a href="manage-categories.php" class="active">Manage Categories</a></li>
                    <li><a href="teacher-statistics.php">Teacher Statistics</a></li>
                    <li><a href="../includes/logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main class="admin-main">
            <h1>Manage Categories</h1>
            <form method="POST" action="">
                <input type="hidden" name="action" value="add_category">
                <input type="text" name="name" placeholder="Category Name" required>
                <button type="submit">Add Category</button>
            </form>

            <div class="categories-table">
                <table>
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?php echo $category['name']; ?></td>
                                <td>
                                    <a href="?delete=<?php echo $category['id']; ?>">Delete</a>
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