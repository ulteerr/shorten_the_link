<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class ContactForm
{
    private $name;
    private $email;
    private $age;
    private $message;


    public function setData($name, $email, $age, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->message = $message;
    }

    public function validForm()
    {
        if (strlen($this->name) < 3)
            return "Имя слишком короткое";
        else if (strlen($this->email) < 3)
            return "Email слишком короткий";
        else if (!is_numeric($this->age) || $this->age <= 0 || $this->age > 90)
            return "Вы ввели не возраст";
        else if (strlen($this->message) < 5)
            return "Сообщение слишком короткое";
        else
            return "Верно";
    }

    public function mail()
    {
        $mail = new PHPMailer(true);
        $Parsedown = new Parsedown();
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.sendgrid.net';
            $mail->SMTPAuth = true;
            $mail->Username = 'apikey';
            $mail->Password = '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';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 25;


            $mail->setFrom('libukinigor@yandex.ru', 'Обратная связь');
            $mail->addAddress('ulterpwnz@list.ru');


            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->isHTML(true);
            $mail->Subject = 'Имя: ' . $this->name . '. Возраст: ' . $this->age . '. Email:' . $this->email;
            $mail->Body = $Parsedown->line('Сообщение: ' . $this->message);

            $mail->send();
            return 'Письмо отправленно';
        } catch (Exception $e) {
            return "Ошибка письмо не отправленно {$mail->ErrorInfo}";
        }

    }


}