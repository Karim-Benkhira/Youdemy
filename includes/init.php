<?php



define('BASE_PATH', dirname(__DIR__));


require_once BASE_PATH . '/classes/Database.php';
require_once BASE_PATH . '/classes/User.php';
require_once BASE_PATH . '/classes/Admin.php';


spl_autoload_register(function ($class) {
    $file = BASE_PATH . '/classes/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});


$db = Database::getInstance()->getConnection();


function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function hasRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

function redirect($path) {
    header("Location: $path");
    exit();
}


function requireAdmin() {
    if (!isLoggedIn() || !hasRole('admin')) {
        redirect('/login.php');
    }
}


function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}