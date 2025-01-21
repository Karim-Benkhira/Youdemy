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

    public function update($data) {
        try {
            $query = "UPDATE courses SET title = :title, description = :description, youtube_link = :youtube_link, 
                      image = :image, content = :content, category_id = :category 
                      WHERE id = :id";
    
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                'id' => $data['id'],
                'title' => $data['title'],
                'description' => $data['description'],
                'youtube_link' => $data['youtube_link'],
                'image' => $data['image'],
                'content' => $data['content'],
                'category' => $data['category']
            ]);
        } catch (PDOException $e) {
            error_log("Course update error: " . $e->getMessage());
            return false;
        }
    }


    public function getAllTags() {
        $query = "SELECT * FROM tags";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCategories() {
        $query = "SELECT * FROM categories";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function getCourseById($course_id) {
        $query = "SELECT c.*, cat.name AS category_name 
                  FROM courses c 
                  JOIN categories cat ON c.category_id = cat.id 
                  WHERE c.id = :course_id";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute(['course_id' => $course_id]);
        $course = $stmt->fetch(PDO::FETCH_ASSOC);

        $course['tags'] = $this->getTagsByCourseId($course_id);
        return $course;
    }


    public function getTagsByCourseId($course_id) {
        $query = "SELECT t.* FROM tags t 
                JOIN course_tags ct ON t.id = ct.tag_id 
                WHERE ct.course_id = :course_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['course_id' => $course_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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