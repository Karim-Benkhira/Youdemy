<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/User.php';
require_once '../classes/Student.php';
require_once '../classes/Teacher.php';
require_once '../classes/Admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($email) && !empty($password)) {
        // Initially try as Student (we can improve this later)
        $user = new Student();
        
        if ($user->login($email, $password)) {
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['role'] = $user->getRole();
            $_SESSION['user_name'] = $user->getName();
            

            switch($user->getRole()) {
                case 'student':
                    header('Location: ../pages/student-dashboard.php');
                    break;
                case 'teacher':
                    header('Location: ../pages/teacher-dashboard.php');
                    break;
                case 'admin':
                    header('Location: ../pages/admin-dashboard.php');
                    break;
                default:
                    header('Location: ../pages/index.php');
            }
            exit;
        } else {
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: ../pages/login.php');
            exit;
        }
    } else {
        $_SESSION['error'] = 'Please fill in all fields';
        header('Location: ../pages/login.php');
        exit;
    }
}