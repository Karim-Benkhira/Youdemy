<?php

class Student extends User {
    public function __construct() {
        parent::__construct();
        $this->role = 'student';
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDashboard() {
        try {
            $query = "SELECT c.*, cat.name as category_name, u.name as teacher_name 
                     FROM courses c 
                     JOIN enrollments e ON c.id = e.course_id 
                     JOIN categories cat ON c.category_id = cat.id 
                     JOIN users u ON c.teacher_id = u.id 
                     WHERE e.student_id = :student_id";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute(['student_id' => $this->id]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Dashboard error: " . $e->getMessage());
            return [];
        }
    }

    public function enrollCourse($courseId) {
        try {
            $query = "INSERT INTO enrollments (student_id, course_id) 
                     VALUES (:student_id, :course_id)";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                'student_id' => $this->id,
                'course_id' => $courseId
            ]);
        } catch (PDOException $e) {
            error_log("Enrollment error: " . $e->getMessage());
            return false;
        }
    }

    public function isEnrolled($courseId) {
        try {
            $query = "SELECT COUNT(*) FROM enrollments 
                     WHERE student_id = :student_id AND course_id = :course_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                'student_id' => $this->id,
                'course_id' => $courseId
            ]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Enrollment check error: " . $e->getMessage());
            return false;
        }
    }
}