<?php
session_start();
require_once __DIR__ . "/../Config/Config.php";

if (!isset($_POST["course_id"]) || !isset($_POST["student_id"])) {
    die("Invalid Request");
}

$course_id = intval($_POST["course_id"]);
$student_id = intval($_POST["student_id"]);

$database = new Database();
$conn = $database->getDB();
$check = $conn->prepare("
    SELECT id 
    FROM enrollments 
    WHERE student_id = ? AND course_id = ?
");
$check->bind_param("ii", $student_id, $course_id);
$check->execute();
$check_result = $check->get_result();

if ($check_result->num_rows > 0) {
    header("Location: ../View/Buy_Course.php?error=already_enrolled");
    exit;
}

$query = $conn->prepare("
    INSERT INTO enrollments (student_id, course_id, enrolled_at)VALUES (?, ?, NOW())");
$query->bind_param("ii", $student_id, $course_id);

if ($query->execute()) {
    header("Location: ../View/Buy_Course.php?enroll_success=1");
    exit;
} else {
    header("Location: ../View/Buy_Course.php?error=failed");
    exit;
}
?>
