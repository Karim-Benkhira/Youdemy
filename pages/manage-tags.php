<?php
require_once '../includes/init.php';
require_once '../classes/Admin.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$admin = new Admin();


$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;


$tags = $admin->getTagsWithPagination($limit, $offset);
$totalTags = $admin->getTotalTags();
$totalPages = ceil($totalTags / $limit);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_tag'])) {
    $tagName = $_POST['tag_name'];
    $admin->addTag($tagName);
    header('Location: manage-tags.php');
    exit();
}


if (isset($_POST['delete_tag'])) {
    $tagId = $_POST['tag_id'];
    $admin->deleteTag($tagId);
    header('Location: manage-tags.php');
    exit();
}


if (isset($_POST['update_tag'])) {
    $tagId = $_POST['tag_id'];
    $tagName = $_POST['tag_name'];
    $admin->updateTag($tagId, $tagName);
    header('Location: manage-tags.php');
    exit();
}


$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $tags = $admin->searchTags($searchTerm);
} else {
    $tags = $admin->getTagsWithPagination($limit, $offset);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tags - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/admin-dashboard.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/manage-tags.css">
</head>
<body>
    <div class="admin-container">
        <aside class="admin-sidebar">
            <h2>Youdemy</h2>
            <nav>
                <ul>
                    <li><a href="admin-dashboard.php">Dashboard</a></li>
                    <li><a href="manage-users.php">Manage Users</a></li>
                    <li><a href="manage-tags.php" class="active">Manage Tags</a></li>
                    <li><a href="admin-manage-courses.php">Manage Courses</a></li>
                    <li><a href="manage-categories.php">Manage Categories</a></li>
                    <li><a href="admin-statistics.php">Statistics</a></li>
                    <li><a href="../includes/logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main class="admin-main">
            <h1>Manage Tags</h1>


            <form method="POST" action="">
                <input type="text" name="search" placeholder="Search tags..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit">Search</button>
            </form>


            <form method="POST" action="">
                <input type="text" name="tag_name" placeholder="Add new tag" required>
                <button type="submit" name="add_tag">Add Tag</button>
            </form>

            <h2>Existing Tags</h2>
            <ul>
                <?php foreach ($tags as $tag): ?>
                    <li>
                        <?php echo htmlspecialchars($tag['name']); ?>
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="tag_id" value="<?php echo $tag['id']; ?>">
                            <input type="text" name="tag_name" placeholder="Update tag" required>
                            <button type="submit" name="update_tag">Update</button>
                            <button type="submit" name="delete_tag">Delete</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>


             <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        </main>
    </div>
</body>
</html>