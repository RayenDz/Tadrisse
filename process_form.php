<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام بيانات النموذج
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

    // إرسال البريد الإلكتروني
    if (mail($emailTo, $emailSubject, $emailBody, $emailHeaders)) {
        echo 'تم إرسال البريد الإلكتروني بنجاح!';
    } else {
        echo 'حدث خطأ أثناء إرسال البريد الإلكتروني.';
    }
} else {
    echo 'طريقة الإرسال غير صحيحة.';
}
?>
