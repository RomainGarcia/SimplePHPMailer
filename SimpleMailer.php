<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Load config
require 'config.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    if ($config["debug"]) {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    }
    $mail->isSMTP();                              
    $mail->Host       = 'smtp.gmail.com';             
    $mail->SMTPAuth   = $config["auth"];                        
    $mail->Username   = $config["username"];                    
    $mail->Password   = $config["password"];                              
    if ($config["tls"]) {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
    }
    $mail->Port       = $config["port"];

    //Recipients
    $mail->setFrom($config["fromEmail"], $config["fromName"]);
    $mail->addAddress($config["recepientEmail"], $config["recepientName"]); 

    // Attachments
    if (file_exists($config["attachementFile"])) {
        $mail->addAttachment($config["attachementFile"]);         // Add attachments
    }

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $config["subject"];
    $body = file_get_contents($config["bodyFile"]) ? file_get_contents($config["bodyFile"]) : "";
    $mail->Body    = $body;
    $mail->AltBody = $config["altBody"];

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
