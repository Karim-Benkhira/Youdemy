<?php

class Course {
    private $db;
    private $id;
    private $title;
    private $description;
    private $teacher_id;
    private $category_id;
    private $status;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data) {
        try {
            $query = "INSERT INTO courses (title, description, youtube_link, image, content, teacher_id, category_id, status) 
                      VALUES (:title, :description, :youtube_link, :image, :content, :teacher_id, :category_id, :status)";
    
            $stmt = $this->db->prepare($query);
            $result = $stmt->execute([
                'title' => $data['title'],
                'description' => $data['description'],
                'youtube_link' => $data['youtube_link'],
                'image' => $data['image'],
                'content' => $data['content'],
                'teacher_id' => $data['teacher_id'],
                'category_id' => $data['category'],
                'status' => 'draft'
            ]);
    
            if ($result) {
                $this->id = $this->db->lastInsertId();
    

                if (!empty($data['tags'])) {
                    foreach ($data['tags'] as $tag_id) {
                        $this->addTagToCourse($this->id, $tag_id);
                    }
                }
    
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Course creation error: " . $e->getMessage());
            return false;
        }
    }
    

    private function addTagToCourse($course_id, $tag_id) {
        $query = "INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['course_id' => $course_id, 'tag_id' => $tag_id]);
    }

    public function getAllCoursesByTeacher($teacher_id) {
        $query = "SELECT c.*, cat.name AS category_name 
                  FROM courses c 
                  JOIN categories cat ON c.category_id = cat.id 
                  WHERE c.teacher_id = :teacher_id";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute(['teacher_id' => $teacher_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        try {
            $query = "UPDATE courses 
                     SET title = :title, 
                         description = :description, 
                         category_id = :category_id, 
                         status = :status 
                     WHERE id = :id";
            
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                'title' => $data['title'],
                'description' => $data['description'],
                'category_id' => $data['category_id'],
                'status' => $data['status'],
                'id' => $id
            ]);
        } catch (PDOException $e) {
            error_log("Course update error: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id) {
        try {
            $query = "DELETE FROM courses WHERE id = :id";
            $stmt = $this->db->prepare($query);
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log("Course deletion error: " . $e->getMessage());
            return false;
        }
    }

    public function getById($id) {
        try {
            $query = "SELECT c.*, u.name as teacher_name, cat.name as category_name 
                     FROM courses c 
                     JOIN users u ON c.teacher_id = u.id 
                     JOIN categories cat ON c.category_id = cat.id 
                     WHERE c.id = :id";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Course retrieval error: " . $e->getMessage());
            return null;
        }
    }

    public function getAllPublished() {
        try {
            $query = "SELECT c.*, u.name as teacher_name, cat.name as category_name 
                     FROM courses c 
                     JOIN users u ON c.teacher_id = u.id 
                     JOIN categories cat ON c.category_id = cat.id 
                     WHERE c.status = 'published'";
            
            $stmt = $this->db->query($query);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Courses retrieval error: " . $e->getMessage());
            return [];
        }
    }
}