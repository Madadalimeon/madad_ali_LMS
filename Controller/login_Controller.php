<?php
session_start();
include __DIR__ . "/../Model/login_Model.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $Login = new Login_model();
    $user = $Login->login($email);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['student_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === "admin") {
                header("Location: http://localhost/madadali_LMS/View/");
                exit;
            } elseif ($user['role'] === "instructor") {
                header("Location: http://localhost/madadali_LMS/View/Instructor_index.php");
                exit;
            } elseif ($user['role'] === "student") {
                header("Location: http://localhost/madadali_LMS/View/student_index.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "wrong_password";
            header("Location: http://localhost/madadali_LMS/View/login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "email_not_found";
        header("Location: http://localhost/madadali_LMS/View/login.php");
        exit;
    }
}
