<?php
require_once '../classes/Database.php';
require_once '../classes/Admin.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$admin = new Admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'get_dashboard_stats':
                $stats = $admin->getDashboard();
                echo json_encode(['status' => 'success', 'data' => $stats]);
                break;
            case 'validate_teacher':
                if (isset($_POST['teacher_id'])) {
                    $result = $admin->validateTeacher($_POST['teacher_id']);
                    echo json_encode(['status' => $result ? 'success' : 'error']);
                }
                break;
            case 'update_user_status':
                if (isset($_POST['user_id']) && isset($_POST['status'])) {
                    $result = $admin->manageUserStatus($_POST['user_id'], $_POST['status']);
                    echo json_encode(['status' => $result ? 'success' : 'error']);
                }
                break;
            case 'delete_course':
                if (isset($_POST['course_id'])) {
                    $result = $admin->deleteCourse($_POST['course_id']);
                    echo json_encode(['status' => $result ? 'success' : 'error']);
                }
                break;
            default:
                echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
                break;
        }
    }
}