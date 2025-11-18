<?php
include __DIR__ . "/../Controller/Register_Controller.php";

$Del_Register = new Register_Controller();

if (isset($_GET['Delete_id'])) {
    $Delete_id = intval($_GET['Delete_id']);

    if ($Del_Register->DeleteRegister($Delete_id)) {
        header("Location: /madadali_LMS/View/tables.php");
        exit;
    } else {
        echo "Delete Register Failed!";
    }
}
