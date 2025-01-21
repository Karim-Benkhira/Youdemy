<?php
require_once '../includes/init.php';
require_once '../classes/Student.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$student = new Student();
$student->setId($_SESSION['user_id']);
$courseId = $_GET['id'] ?? null;

if ($courseId) {

    if (!$student->isEnrolled($courseId)) {

        $result = $student->enrollCourse($courseId);
        
        if ($result) {
            header('Location: my_courses.php');
            exit();
        } else {
            echo "Error enrolling in the course.";
        }
    } else {
        echo "You are already enrolled in this course.";
    }
}
?>