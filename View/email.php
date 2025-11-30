<?php
session_start();
if (!isset($_SESSION['email'])) {
    die("Student email not found in session");
}

$student_email = $_SESSION['email'];
echo $student_email;
echo "<br>".$_SESSION['name'] . " <br>" . $_SESSION['S_title'] . " <br>" . $_SESSION['S_instructor_name'] . "<br> " . $_SESSION['S_course_price'];
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
    $mail->Subject = $_SESSION['S_title'] . " - " . $_SESSION['S_course_price'];

    $mail->Body = "
        Hello <b>{$_SESSION['name']}</b>,<br><br>
        Thank you for enrolling in our course!<br><br>
        <b>Course Title:</b> {$_SESSION['S_title']}<br>
        <b>Instructor:</b> {$_SESSION['S_instructor_name']}<br>
        <b>Price:</b> {$_SESSION['S_course_price']}<br><br>
        Best regards,<br>
        The Course Team
    ";

    $mail->AltBody = "Hello {$_SESSION['name']}, Course Price: {$_SESSION['S_course_price']}";

    $mail->send();
} catch (Exception $e) {
    echo "Student email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


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
    $mail->addAddress("madadalimemon90@gmail.com");
    $mail->addReplyTo('madadalimemon90@gmail.com', 'HR System');

    $mail->isHTML(true);
    $mail->Subject = "New Student Enrollment";

    $mail->Body = "
        <h3>New Enrollment Notification</h3>
        <p><strong>Student:</strong> {$_SESSION['name']}</p>
        <p><strong>Email:</strong> {$_SESSION['email']}</p>
        <p><strong>Course Enrolled:</strong> {$_SESSION['S_title']}</p>
        <p>This student has successfully enrolled in the course.</p>
    ";
    $mail->AltBody = "New Enrollment:\nStudent: {$_SESSION['name']}\nEmail: {$_SESSION['email']}\nCourse: {$_SESSION['S_title']}";
    $mail->send();
} catch (Exception $e) {
    echo "Admin email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
if (isset($_SESSION['name'])) {
    header("Location: http://localhost/madadali_LMS/View/Buy_Course.php?enroll_success=true");    
    exit;
}