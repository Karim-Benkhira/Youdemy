<?php

class Category {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($name, $description = '') {
        try {
            $query = "INSERT INTO categories (name, description) 
                     VALUES (:name, :description)";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                'name' => $name,
                'description' => $description
            ]);
        } catch (PDOException $e) {
            error_log("Category creation error: " . $e->getMessage());
            return false;
        }
    }

    public function getAll() {
        try {
            $query = "SELECT * FROM categories";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Categories retrieval error: " . $e->getMessage());
            return [];
        }
    }

    public function update($id, $name, $description = '') {
        try {
            $query = "UPDATE categories 
                     SET name = :name, description = :description 
                     WHERE id = :id";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                'name' => $name,
                'description' => $description,
                'id' => $id
            ]);
        } catch (PDOException $e) {
            error_log("Category update error: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id) {
        try {
            $query = "DELETE FROM categories WHERE id = :id";
            $stmt = $this->db->prepare($query);
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log("Category deletion error: " . $e->getMessage());
            return false;
        }
    }
}