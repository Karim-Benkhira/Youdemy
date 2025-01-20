<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Course.php';
require_once '../classes/Student.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course = new Course();
    $student = new Student();
    $student->setId($_SESSION['user_id']);

    $data = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'category_id' => $_POST['category_id'],
        'teacher_id' => $student->getId()
    ];

    if ($course->create($data)) {
        $_SESSION['success'] = 'Course added successfully!';
    } else {
        $_SESSION['error'] = 'Failed to add course.';
    }
    header('Location: ../pages/student-dashboard.php');
    exit;
}