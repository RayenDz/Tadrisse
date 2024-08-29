<?php
// ملف process_form.php

// التحقق من القيم المدخلة
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$subject = htmlspecialchars($_POST['subject']);
$message = htmlspecialchars($_POST['message']);

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

// إرسال البريد الإلكتروني والتحقق من نجاح الإرسال
if(mail($emailTo, $emailSubject, $emailBody, $emailHeaders)) {
    echo 'تم إرسال البريد الإلكتروني بنجاح!';
} else {
    echo 'حدث خطأ أثناء إرسال البريد الإلكتروني.';
}

// إعداد الرسالة النصية باستخدام Twilio
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

// إرسال رسالة إلى الرقم الذي ترغب به
$client->messages->create(
    'YOUR_PHONE_NUMBER',
    ['from' => $twilioNumber, 'body' => $notificationMessage]
);

echo 'تم إرسال الرسائل بنجاح!';
?>
