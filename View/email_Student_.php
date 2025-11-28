<?php
session_start();

if (!isset($_SESSION["student_email"])) {
    die("Student email not found in session");
}

$student_email = $_SESSION["student_email"];
echo $student_email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

try {
    $mail = new PHPMailer(true);

    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'madadalimemon90@gmail.com';
    $mail->Password   = 'hfcf ohbk htrg hgeg';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('madadalimemon90@gmail.com', 'HR System');
    $mail->addAddress($student_email);
    $mail->addReplyTo('madadalimemon90@gmail.com', 'HR System');

    $mail->isHTML(true);
    $mail->Subject = "Course Enrollment Confirmation";
    $mail->Body = "
        Hello Student,<br><br>
        You have successfully <b>enrolled</b> in the course.<br>
        We are happy to have you with us!<br><br>
        Best regards,<br>
        The Course Team
    ";

    $mail->AltBody = "Hello Student, You have successfully enrolled in the course.";

    $mail->send();
} catch (Exception $e) {
    echo "Student email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
if (isset($_SESSION["student_email"])) {
    header("Location: http://localhost/madadali_LMS/View/Enrollment.php?enroll_id=success");
    exit;
}
