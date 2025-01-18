<?php
require_once '../classes/Database.php';

$db = Database::getInstance()->getConnection();

$name = 'Admin User';
$email = 'admin@example.com';
$password = password_hash('123456', PASSWORD_DEFAULT); 
$role = 'admin';
$status = 'active';

$query = "INSERT INTO users (name, email, password, role, status, created_at) 
          VALUES (:name, :email, :password, :role, :status, NOW())";

$stmt = $db->prepare($query);
$stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':password' => $password,
    ':role' => $role,
    ':status' => $status
]);

echo "Admin user created successfully!";
?>