<?php
include __DIR__ . "/../Config/Config.php";
class Course_model
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getDB();
    }

    public function AddCourse($title, $description, $user_id, $price)
    {
        $Add_Course = "INSERT INTO courses(title,description,instructor_id,price)VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($Add_Course);
        $stmt->bind_param("ssii", $title, $description, $user_id, $price);
        return $stmt->execute();
    }
    public function UpdateCourse($update_id, $title, $description, $price)
    {
        $query = "UPDATE courses SET title = ?, description = ?, price = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssdi", $title, $description, $price, $update_id);

        return $stmt->execute();
    }

    public function DeleteCourse($Course_Delete_id)
    {
        $Delete_id = "DELETE FROM courses WHERE id = ?";
        $stmt = $this->conn->prepare($Delete_id);
        $stmt->bind_param("i", $Course_Delete_id);
        return $stmt->execute();
    }


    // start lesson

    public function Addlesson($course_id, $title, $content, $video_url)
    {
        $Add_lesson = "INSERT INTO lessons(course_id,title,content,video_url)VALUES(?,?,?,?)";
        $stmt = $this->conn->prepare($Add_lesson);
        $stmt->bind_param("isss", $course_id, $title, $content, $video_url);
        return $stmt->execute();
    }
    public function Deletelesson($Delete_id)
    {
        $Deletelesson = "DELETE FROM lessons WHERE id = ?";
        $stmt = $this->conn->prepare($Deletelesson);
        $stmt->bind_param("i", $Delete_id);
        return $stmt->execute();
    }

    public function updatelesson($Lesson_title, $Lesson_content, $Lesson_video_url, $lessons_Update_id)
    {
        $query = "UPDATE lessons SET title = ?, content = ?, video_url = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $Lesson_title, $Lesson_content, $Lesson_video_url, $lessons_Update_id);
         return $stmt->execute();
    }
}
// start end