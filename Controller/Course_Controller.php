<?php
include __DIR__ . "/../Model/Course_model.php";
session_start();
$course = new Course_model;
if (isset($_GET['Delete_id'])) {
    $Course_Delete_id = intval($_GET['Delete_id']);
    echo $Course_Delete_id;
    if ($course->DeleteCourse($Course_Delete_id)) {
        header("Location: http://localhost/madadali_LMS/View/MYCourse.php?Delete_id");
        exit;
    } else {
        echo "Course Delete Failed!";
    }
}


if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['title'])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $user_id = intval($_POST["user_id"]);
    $price =   intval($_POST["price"]);
    if ($course->AddCourse($title, $description, $user_id, $price)) {
        $_SESSION['success'] = "Course added successfully!";
        header("Location: http://localhost/madadali_LMS/View/MYCourse.php");
        exit;
    } else {
        $_SESSION['error'] = "Something went wrong!";
    }
}
if (isset($_POST['Update_title'])) {
    $update_id = $_POST['update_id'];
    $Update_title = $_POST['Update_title'];
    $Update_description = $_POST['Update_description'];
    $Update_price = $_POST['Update_price'];
    $Update_Course = new Course_model();
    if ($Update_Course->UpdateCourse($update_id, $Update_title, $Update_description, $Update_price)) {
        header("Location: http://localhost/madadali_LMS/View/MYCourse.php?update=success");
        exit;
    } else {
        header("Location: http://localhost/madadali_LMS/View/MYCourse.php?update=error");
        exit;
    }
}
