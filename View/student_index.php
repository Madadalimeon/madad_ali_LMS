<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "studentx") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include __DIR__."/../include/header.php";
echo $_SESSION['name'];
?>


<?php
include __DIR__."/../include/footer.php";
?>