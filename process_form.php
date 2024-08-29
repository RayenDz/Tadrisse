<?php
// ملف process_form.php

// بيانات النموذج
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// إعداد البريد الإلكتروني
$emailTo = 'rekabrayen@gmail.com';
$emailSubject = 'تسجيل جديد من موقعك';
$emailHeaders = "MIME-Version: 1.0" . "\r\n";
$emailHeaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$emailHeaders .= 'From: noreply@example.com' . "\r\n";

$emailBody = "<html>
<body>
    <h2>تسجيل جديد</h2>
    <p><strong>الاسم:</strong> $name</p>
    <p><strong>البريد الإلكتروني:</strong> $email</p>
    <p><strong>رقم الهاتف:</strong> $phone</p>
    <p><strong>الموضوع:</strong> $subject</p>
    <p><strong>الرسالة:</strong> $message</p>
</body>
</html>";

// إرسال البريد الإلكتروني
mail($emailTo, $emailSubject, $emailBody, $emailHeaders);

// إعداد الرسالة النصية
require_once 'vendor/autoload.php';
use Twilio\Rest\Client;

$sid = 'YOUR_TWILIO_SID';
$token = 'YOUR_TWILIO_AUTH_TOKEN';
$twilioNumber = 'YOUR_TWILIO_PHONE_NUMBER';

$userMessage = "شكرًا لتسجيلك! سنتواصل معك قريباً.";
$notificationMessage = "تسجيل جديد: \nالاسم: $name\nالبريد الإلكتروني: $email\nرقم الهاتف: $phone\nالموضوع: $subject\nالرسالة: $message";

$client = new Client($sid, $token);

// إرسال رسالة إلى المستخدم
$client->messages->create(
    $phone,
    ['from' => $twilioNumber, 'body' => $userMessage]
);

// إرسال رسالة إليك
$client->messages->create(
    $emailTo,
    ['from' => $twilioNumber, 'body' => $notificationMessage]
);

echo 'تم إرسال الرسائل بنجاح!';
?>

