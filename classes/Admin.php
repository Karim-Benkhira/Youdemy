<?php

class Admin extends User {
    public function __construct() {
        parent::__construct();
        $this->role = 'admin';
    }

    public function getDashboard() {
        try {
            $stats = [
                'total_users' => $this->getTotalUsers(),
                'total_courses' => $this->getTotalCourses(),
                'pending_teachers' => $this->getPendingTeachers(),
                'top_courses' => $this->getTopCourses(),
                'categories_stats' => $this->getCategoriesStats(),
                // 'courses_per_teacher' => $this->getCoursesPerTeacher(),
                // 'students_per_course' => $this->getStudentsPerCourse(),
            ];
            return $stats;
        } catch (PDOException $e) {
            error_log("Admin dashboard error: " . $e->getMessage());
            return [];
        }
    }

    private function getTotalUsers() {
        $query = "SELECT COUNT(*) FROM users";
        return $this->db->query($query)->fetchColumn();
    }

    private function getTotalCourses() {
        $query = "SELECT COUNT(*) FROM courses";
        return $this->db->query($query)->fetchColumn();
    }

    private function getPendingTeachers() {
        $query = "SELECT COUNT(*) FROM users WHERE role = 'teacher' AND status = 'pending'";
        return $this->db->query($query)->fetchColumn();
    }

    private function getTopCourses() {
        $query = "SELECT c.*, COUNT(e.student_id) as student_count
                  FROM courses c
                  LEFT JOIN enrollments e ON c.id = e.course_id
                  GROUP BY c.id
                  ORDER BY student_count DESC
                  LIMIT 3";
        return $this->db->query($query)->fetchAll();
    }

    private function getCategoriesStats() {
        $query = "SELECT c.name as category_name,
                         COUNT(co.id) as course_count,
                         COUNT(DISTINCT e.student_id) as student_count
                  FROM categories c
                  LEFT JOIN courses co ON c.id = co.category_id
                  LEFT JOIN enrollments e ON co.id = e.course_id
                  GROUP BY c.id";
        return $this->db->query($query)->fetchAll();
    }

    public function validateTeacher($teacherId) {
        $query = "UPDATE users SET status = 'active' WHERE id = :teacher_id AND role = 'teacher'";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['teacher_id' => $teacherId]);
    }

    public function manageUserStatus($userId, $status) {
        $query = "UPDATE users SET status = :status WHERE id = :user_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['status' => $status, 'user_id' => $userId]);
    }
    public function addCourse($title, $description) {
        $query = "INSERT INTO courses (title, description) VALUES (:title, :description)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['title' => $title, 'description' => $description]);
    }

    public function getAllCourses() {
        $query = "SELECT id, title, description FROM courses";
        return $this->db->query($query)->fetchAll();
    }

    public function deleteCourse($courseId) {
        $query = "DELETE FROM courses WHERE id = :course_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['course_id' => $courseId]);
    }

    public function getAllUsers() {
        $query = "SELECT id, name, email, role, status FROM users";
        return $this->db->query($query)->fetchAll();
    }


    public function getAllCategories() {
        $query = "SELECT id, name FROM categories";
        return $this->db->query($query)->fetchAll();
    }
    
    public function addCategory($name) {
        $query = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['name' => $name]);
    }
    
    public function deleteCategory($categoryId) {
        $query = "DELETE FROM categories WHERE id = :category_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['category_id' => $categoryId]);
    }

    public function deleteUser($userId) {
        $query = "DELETE FROM users WHERE id = :user_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['user_id' => $userId]);
    }

    public function searchUsers($searchTerm) {
        $query = "SELECT * FROM users WHERE name LIKE :searchTerm OR email LIKE :searchTerm";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);
        return $stmt->fetchAll();
    }

    public function filterUsersByStatus($status) {
        $query = "SELECT * FROM users";
        if ($status) {
            $query .= " WHERE status = :status";
        }
        $stmt = $this->db->prepare($query);
        if ($status) {
            $stmt->execute(['status' => $status]);
        } else {
            $stmt->execute();
        }
        return $stmt->fetchAll();
    }

    public function getCoursesPerTeacher() {
        $query = "SELECT COUNT(*) FROM courses WHERE teacher_id IS NOT NULL";
        $count = $this->db->query($query)->fetchColumn();
        return $count !== false ? $count : 0;
    }
    
    public function getStudentsPerCourse() {
        $query = "SELECT COUNT(*) FROM students";
        $count = $this->db->query($query)->fetchColumn();
        return $count !== false ? $count : 0;
    }

    public function addTag($tagName) {
        $query = "INSERT INTO tags (name) VALUES (:name)";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['name' => $tagName]);
    }
    
    public function getAllTags() {
        $query = "SELECT * FROM tags";
        return $this->db->query($query)->fetchAll();
    }

    public function deleteTag($tagId) {
        $query = "DELETE FROM tags WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $tagId]);
    }
    
    public function updateTag($tagId, $tagName) {
        $query = "UPDATE tags SET name = :name WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['name' => $tagName, 'id' => $tagId]);
    }
    
    public function searchTags($searchTerm) {
        $query = "SELECT * FROM tags WHERE name LIKE :searchTerm";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);
        return $stmt->fetchAll();
    }

    public function getTagsWithPagination($limit, $offset) {
        $query = "SELECT * FROM tags LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getTotalTags() {
        $query = "SELECT COUNT(*) FROM tags";
        return $this->db->query($query)->fetchColumn();
    }
}