<?php
// Aktifkan penampilan kesalahan untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.cloudtech.id';                    // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'ati@cloudtech.id';                 // SMTP username
            $mail->Password = 'M4jutakgentar';                    // SMTP password
            $mail->SMTPSecure = 'tls';                          // Enable TLS encryption, ssl also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            // $mail->setFrom($email, $name);
            $mail->setFrom('suciiamm@gmail.com', 'suciiamm@gmail.com');
            // $mail->addAddress('suciiamm@gmail.com', 'suci'); // Ganti dengan email tujuan
            $mail->addAddress($email, $name);     // Add a recipient

            $mail->isHTML(true);
            $mail->Subject = "New Message from: $name";
            $mail->Body    = "You have received a new message from the contact form on your website.<br><br>".
                             "<strong>Name:</strong> $name<br>".
                             "<strong>Email:</strong> $email<br>".
                             "<strong>Subject:</strong> $subject<br>".
                             "<strong>Message:</strong><br>$message";

            $mail->send();
            echo 'Your message has been sent. Thank you!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Please fill in all fields.";
    }
} else {
    echo "Invalid request.";
}


?>