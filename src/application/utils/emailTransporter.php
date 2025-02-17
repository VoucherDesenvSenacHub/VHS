<?php

namespace Src\Application\Utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . "/../../../vendor/autoload.php";

class EmailTransporter {
    private PHPMailer $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);

        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mail->isSMTP();
        $this->mail->Host = $_ENV["SMTP_HOST"];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $_ENV["SMTP_USER"];
        $this->mail->Password = $_ENV["SMTP_PASS"];
        $this->mail->Port = $_ENV["SMTP_PORT"];
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = $_ENV["SMTP_PORT"];
    }

    public function sendEmail(string $email, string $name, string $subject, string $body) {
        $this->mail->setFrom($_ENV["SMTP_USER"], $_ENV["SMTP_NAME"]);
        $this->mail->addAddress($email, $name);
        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;

        $this->mail->send();
    }
}