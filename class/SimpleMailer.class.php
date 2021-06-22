<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Instantiation and passing `true` enables exceptions

class SimpleMailer 
{
    private $m_Config;

    function __construct($config) {
        $this->m_Config = $config;
    }

    function send() {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            if ($this->m_Config["debug"]) {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
            }
            $mail->isSMTP();                              
            $mail->Host       = $this->m_Config["host"];             
            $mail->SMTPAuth   = $this->m_Config["auth"];                        
            $mail->Username   = $this->m_Config["username"];                    
            $mail->Password   = $this->m_Config["password"];                              
            if ($this->m_Config["tls"]) {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
            }
            $mail->Port       = $this->m_Config["port"];
        
            //Recipients
            $mail->setFrom($this->m_Config["fromEmail"], $this->m_Config["fromName"]);
            $mail->addAddress($this->m_Config["recipientEmail"], $this->m_Config["recipientName"]);
        
            // Attachments
            if (file_exists($this->m_Config["attachmentFile"])) {
                $mail->addAttachment($this->m_Config["attachmentFile"]);         // Add attachments
            }
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $this->m_Config["subject"];
            $body = file_get_contents($this->m_Config["bodyFile"]) ? file_get_contents($this->m_Config["bodyFile"]) : "";
            $mail->Body    = $body;
            $mail->AltBody = $this->m_Config["altBody"];
        
            $mail->send();
            echo 'Message has been sent';
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
            return false;
        }
    }

}





