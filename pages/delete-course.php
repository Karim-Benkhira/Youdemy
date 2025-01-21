<?php
require_once '../includes/init.php';
require_once '../classes/Course.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header('Location: login.php');
    exit();
}

$course = new Course();

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    if ($course->delete($course_id)) {
        header('Location: manage-courses.php');
        exit();
    } else {
        echo "Failed to delete course.";
    }
} else {
    header('Location: manage-courses.php');
    exit();
}