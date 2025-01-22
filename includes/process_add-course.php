<?php
require_once '../includes/init.php';
require_once '../classes/Teacher.php';
require_once '../classes/Course.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header('Location: ../login.php');
    exit();
}

$teacher = new Teacher();
$teacherId = $_SESSION['user_id'];


$categories = $teacher->getCategories();
$tags = $teacher->getTags();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'title' => $_POST['title'] ?? '',
        'description' => $_POST['description'] ?? '',
        'youtube_link' => $_POST['youtube_link'] ?? '',
        'content' => $_POST['content'] ?? '',
        'teacher_id' => $_SESSION['user_id'] ?? '',
        'category' => $_POST['category'] ?? '',
        'tags' => $_POST['tags'] ?? []
    ];

    // if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    //     $imageName = $_FILES['image']['name'];
    //     $imageTmpName = $_FILES['image']['tmp_name'];
    //     $imagePath = '../assets/images/courses/image_uploads/' . $imageName;
    //     move_uploaded_file($imageTmpName, $imagePath);
    //     $data['image'] = $imageName;
    // }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/images/courses/image_upload/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {

            $data['image'] = $uploadFile;
        } else {

            echo "Error uploading the file.";
        }
    } else {

        echo "No file uploaded or there was an upload error.";
    }

    $course = new Course();
    if ($course->create($data)) {
        header('Location: teacher-dashboard.php');
        exit();
    } else {
        $error = "Failed to add course.";
    }
}
?>