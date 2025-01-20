<?php
require_once '../includes/init.php';
require_once '../classes/Admin.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$admin = new Admin();


$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $users = $admin->searchUsers($searchTerm);
} else {
    $users = $admin->getAllUsers();
}



if (isset($_POST['status_filter'])) {
    $statusFilter = $_POST['status_filter'];
    $users = $admin->filterUsersByStatus($statusFilter);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $userId = $_POST['user_id'];
    $status = $_POST['status'];

    if ($_POST['action'] === 'update_user_status') {
        $admin->manageUserStatus($userId, $status);
        $message = "User status updated successfully!";
    } elseif ($_POST['action'] === 'delete_user') {
        $admin->deleteUser($userId);
        $message = "User deleted successfully!";
    }

    header('Location: manage-users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/admin-dashboard.css">
    <link rel="stylesheet" href="../assets/css/manage-users.css">
    <link rel="stylesheet" href="../assets/css/style.css">


    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this user?");
        }
    </script>
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
                    <li><a href="manage-users.php" class="active">Manage Users</a></li>
                    <li><a href="admin-manage-courses.php">Manage Courses</a></li>
                    <li><a href="manage-categories.php">Manage Categories</a></li>
                    <li><a href="admin-statistics.php">Statistics</a></li>
                    <li><a href="../includes/logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main class="admin-main">
            <h1>Manage Users</h1>
            <?php if (isset($message)): ?>
                <div class="notification"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <input type="text" name="search" placeholder="Search users..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit">Search</button>
            </form>


            <form method="POST" action="">
                <select name="status_filter">
                    <option value="">All Users</option>
                    <option value="active" <?php echo $statusFilter === 'active' ? 'selected' : ''; ?>>Active</option>
                    <option value="pending" <?php echo $statusFilter === 'pending' ? 'selected' : ''; ?>>Pending</option>
                </select>
                <button type="submit">Filter</button>
            </form>
            
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td><?php echo $user['status']; ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <select name="status">
                                        <option value="active" <?php echo $user['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                                        <option value="pending" <?php echo $user['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                    </select>
                                    <button type="submit" name="action" value="update_user_status" class="btn-update">Update</button>
                                    <button type="submit" name="action" value="delete_user" onclick="return confirmDelete();" class="btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>