<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/User.php';
require_once '../classes/Student.php';
require_once '../classes/Teacher.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';
    
    if (!empty($name) && !empty($email) && !empty($password) && !empty($role)) {
        $user = $role === 'teacher' ? new Teacher() : new Student();
        
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];
        
        if ($user->register($data)) {
            $_SESSION['success'] = 'Registration successful!';
        } else {
            $_SESSION['error'] = 'Registration failed';
        }
    } else {
        $_SESSION['error'] = 'Please fill in all fields';
    }
}

header('Location: ../pages/register.php');
exit;