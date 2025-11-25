<?php
session_start();
include __DIR__ . "/../Model/Course_model.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $course_id  = $_POST['course_id'];
    $student_id = $_POST['student_id'];

    $model = new Course_model();
    $success = $model->EnrollCourse($course_id, $student_id);

    if ($success) {
        $_SESSION["enroll_success"] = true;
        header("Location: ../View/Buy_Course.php?enroll_id=success&course_id=" . $course_id);
        exit();
    } else {
        echo "Enrollment failed.";
    }
}
