<?php
require_once 'init.php';
require_once '../classes/Student.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


$student = new Student();
// $course = new Course();
$student->setId($_SESSION['user_id']);

// $searchTerm = '';
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $searchTerm = $_POST['search'] ?? '';
//     $courses = $course->searchCourses($searchTerm);
// } else {
//     $courses = $student->getAllCourses(); 
// }
 $courses = $student->getAllCourses();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseId = $_POST['course_id'] ?? null;

    if ($courseId) {
        if (!$student->isEnrolled($courseId)) {
            $student->enrollCourse($courseId);
            $message = "You have successfully subscribed to the course!";
        } else {
            $message = "You are already enrolled in this course.";
        }
    } else {
        $message = "Invalid course ID.";
    }
}
?>