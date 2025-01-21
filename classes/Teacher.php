<?php
class Teacher extends User {
    public function __construct() {
        parent::__construct();
        $this->role = 'teacher';
    }

    // public function getDashboard() {
    //     $query = "SELECT c.*, 
    //                      COUNT(DISTINCT e.student_id) as student_count,
    //                      cat.name as category_name 
    //               FROM courses c 
    //               LEFT JOIN enrollments e ON c.id = e.course_id 
    //               JOIN categories cat ON c.category_id = cat.id 
    //               WHERE c.teacher_id = :teacher_id 
    //               GROUP BY c.id";

    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute(['teacher_id' => $this->id]);
    //     return $stmt->fetchAll();
    // }

    public function getDashboard() {
        $query = "SELECT c.*, 
                         COUNT(DISTINCT e.student_id) AS student_count 
                  FROM courses c 
                  LEFT JOIN enrollments e ON c.id = e.course_id 
                  WHERE c.teacher_id = :teacher_id 
                  GROUP BY c.id";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute(['teacher_id' => $this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalCourses() {
    
        $query = "SELECT COUNT(*) AS total_courses 
                  FROM courses 
                  WHERE teacher_id = :teacher_id";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute(['teacher_id' => $_SESSION['user_id']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total_courses'];
    }

    // public function createCourse($data) {
    //     try {
    //         $query = "INSERT INTO courses (title, description, teacher_id, category_id) 
    //                   VALUES (:title, :description, :teacher_id, :category_id)";

    //         $stmt = $this->db->prepare($query);
    //         return $stmt->execute([
    //             'title' => $data['title'],
    //             'description' => $data['description'],
    //             'teacher_id' => $this->id,
    //             'category_id' => $data['category_id']
    //         ]);
    //     } catch (PDOException $e) {
    //         error_log("Course creation error: " . $e->getMessage());
    //         return false;
    //     }
    // }

    // public function updateCourse($courseId, $data) {
    //     try {
    //         $query = "UPDATE courses 
    //                   SET title = :title, 
    //                       description = :description, 
    //                       category_id = :category_id 
    //                   WHERE id = :course_id AND teacher_id = :teacher_id";

    //         $stmt = $this->db->prepare($query);
    //         return $stmt->execute([
    //             'title' => $data['title'],
    //             'description' => $data['description'],
    //             'category_id' => $data['category_id'],
    //             'course_id' => $courseId,
    //             'teacher_id' => $this->id
    //         ]);
    //     } catch (PDOException $e) {
    //         error_log("Course update error: " . $e->getMessage());
    //         return false;
    //     }
    // }

    // public function deleteCourse($courseId) {
    //     try {
    //         $query = "DELETE FROM courses WHERE id = :course_id AND teacher_id = :teacher_id";
    //         $stmt = $this->db->prepare($query);
    //         return $stmt->execute([
    //             'course_id' => $courseId,
    //             'teacher_id' => $this->id
    //         ]);
    //     } catch (PDOException $e) {
    //         error_log("Course deletion error: " . $e->getMessage());
    //         return false;
    //     }
    // }

    public function getCategories() {
        $query = "SELECT * FROM categories";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTags() {
        $query = "SELECT * FROM tags";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getEnrolledStudents($courseId) {
        $query = "SELECT s.* 
                  FROM students s 
                  JOIN enrollments e ON s.id = e.student_id 
                  WHERE e.course_id = :course_id";

        $stmt = $this->db->prepare($query);
        $stmt->execute(['course_id' => $courseId]);
        return $stmt->fetchAll();
    }


    public function banStudentFromCourse($studentId, $courseId) {
        try {
            $query = "DELETE FROM enrollments 
                      WHERE student_id = :student_id AND course_id = :course_id";

            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                'student_id' => $studentId,
                'course_id' => $courseId
            ]);
        } catch (PDOException $e) {
            error_log("Ban student error: " . $e->getMessage());
            return false;
        }
    }

    public function getTeacherInfo($teacherId) {
        try {
            $query = "SELECT * FROM users WHERE id = :teacher_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['teacher_id' => $teacherId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : null;
        } catch (PDOException $e) {
            error_log("Get teacher info error: " . $e->getMessage());
            return null;
        }
    }
}