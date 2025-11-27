<?php
include __DIR__ . "/../Config/Config.php";
$database = new Database();
$conn = $database->getDB();
if (isset($_GET['approve_id'])) {
    $approve_id = intval($_GET['approve_id']);
    $query = "UPDATE courses SET status ='Approve' WHERE id = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $approve_id);
    if ($stmt->execute()) {
        header("Location: http://localhost/madadali_LMS/View/Approve.php?msg=Approve");
        exit;
    }
}
if (isset($_GET['reject_id'])) {
    $reject_id = intval($_GET['reject_id']);
    $query = "UPDATE courses SET status ='Reject' WHERE id = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $reject_id);
    if ($stmt->execute()) {
        header("Location: http://localhost/madadali_LMS/View/Approve.php?msg=Reject");
        exit;
    }
}


// start the Eroll course
if (isset($_GET['Enroll_id'])) {
    $enroll_id = intval($_GET['Enroll_id']);
    $query = "UPDATE enrollments SET enroll ='enroll' WHERE id = ? ";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("i", $enroll_id);
    if ($stmt->execute()) {
        header("Location: http://localhost/madadali_LMS/View/Enrollment.php?enroll_id=success");
        exit;
    }
    
}
// end the Eroll course