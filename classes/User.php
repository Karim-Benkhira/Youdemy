<?php

abstract class User {
    protected $id;
    protected $name;
    protected $email;
    protected $role;
    protected $status;
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function login($email, $password) {
        try {
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $this->id = $user['id'];
                $this->name = $user['name'];
                $this->email = $user['email'];
                $this->role = $user['role'];
                $this->status = $user['status'];
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            return false;
        }
    }

    public function register($data) {
        try {
            $query = "INSERT INTO users (name, email, password, role) 
                     VALUES (:name, :email, :password, :role)";
            $stmt = $this->db->prepare($query);
            
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            
            return $stmt->execute([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $hashedPassword,
                'role' => $this->role
            ]);
        } catch (PDOException $e) {
            error_log("Registration error: " . $e->getMessage());
            return false;
        }
    }

    public function getName() {
        try {
            $query = "SELECT name FROM users WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['id' => $this->id]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log("Error getting user name: " . $e->getMessage());
            return null;
        }
    }

    // Getters
    //public function getId() { return $this->id; }
    // public function getName() { return $this->name; }
    //public function getEmail() { return $this->email; }
    //public function getRole() { return $this->role; }
    //public function getStatus() { return $this->status; }
    // Abstract methods that must be implemented by child classes
    //abstract public function getDashboard();
}