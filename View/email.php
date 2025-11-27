<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
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
    $mail->addAddress('madadalim903@gmail.com');             
    $mail->addReplyTo('madadalimemon90@gmail.com', 'HR System');

    $mail->isHTML(true);
    $mail->Subject = 'OTP Verification Code';
    $mail->Body    = "Hello,<br><br>Your OTP verification code is: <b>$OTP</b><br><br>Do not share this code with anyone.";
    $mail->AltBody = "Hello, Your OTP verification code is: $OTP. Do not share this code with anyone.";

    $mail->send();
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>