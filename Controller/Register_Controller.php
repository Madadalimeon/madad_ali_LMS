<?php
include __DIR__ . "/../Model/Register_model.php";
if ($_SERVER['REQUEST_METHOD'] === "POST"  ) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $User = new Register_model($name, $email, $hash_password, $role);
    if ($User->Register()) {
        header("Location: http://localhost/madadali_LMS/View/tables.php");
        exit;
      echo "Registration Failed!";
    }
}


if (isset($_GET['Delete_id'])) {
    $Delete_id = intval($_GET['Delete_id']);
    $User = new Register_model();
    if ($User->Delete_Register($Delete_id)) {
        header("Location: http://localhost/madadali_LMS/View/tables.php");
        exit;
    }else {
        echo " Delete id Failed!";
    }
}