<?php
session_start();

$imagePath = __DIR__ . '/../certificate.png';
$image = imagecreatefrompng($imagePath);

$textColor = imagecolorallocate($image, 0, 0, 0);

$paid = "RS. " . number_format($_GET['C_price'], 2) . " PKR";
$C_title = $_GET['C_title'];
$I_name = $_GET['I_name'];

$font = __DIR__ . '/../ARIAL.TTF';
$fontSize = 15;
$user_name = $_SESSION['name'];

$recipientName = "This is to certify that MR. $user_name Successfully completed the coures by  $I_name  ";
$Couesr_title = "Couesr title: $C_title";
$price = "Paid Price: $paid";

imagettftext($image, $fontSize, 0, 80, 400, $textColor, $font, $recipientName);
imagettftext($image, $fontSize, 0, 80, 435, $textColor, $font, $Couesr_title);
imagettftext($image, $fontSize - 4, 0, 80, 550, $textColor, $font, $price);

header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="certificate.png"');

imagepng($image);
imagedestroy($image);
exit;
