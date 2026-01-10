<?php

namespace App\Services;

use Config\Email as EmailConfig;

use App\Interfaces\EmailInterface;

class EmailService implements EmailInterface
{

    public function emailSend(string|array $recipientEmail, string $subject, string $message)
    {

        if (empty($recipientEmail)) return false;

        $emailConfig = new EmailConfig();
       
        $email = \Config\Services::email($emailConfig);

        if (!is_array($recipientEmail)) {
            $recipientEmail = [$recipientEmail];
        }

        $email->setTo($recipientEmail);
        $email->setFrom($emailConfig->fromEmail, $emailConfig->fromName);
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            return true;
        } else {
            print_r($email->printDebugger());
            die();

            return false;
        }
    }
}
