<?php

require "./libs/PHPMailer/Exception.php";
require "./libs/PHPMailer/OAuth.php";
require "./libs/PHPMailer/PHPMailer.php";
require "./libs/PHPMailer/POP3.php";
require "./libs/PHPMailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Message {
    private $to = null;
    private $subject = null;
    private $message = null;

        public function __get($attr) {
            return $this->$attr;
        }

        public function __set($attr, $value) {
            $this->$attr = $value;

        }

        public function validateMessage() {
            if(empty($this->to) || empty($this->subject) || empty($this->message))  {
                echo "Mensagem inválida.";
                return false;
            }
            echo "mensagem válida!";
            return true;
        }
}

$to = filter_input(INPUT_POST, 'to');
$subject = filter_input(INPUT_POST, 'subject');
$message = filter_input(INPUT_POST, 'message');

$email = new Message();

// utilizar o __set não é realmente necessário, dá para utilizar apenas $email->valor = $valor
$email->__set('to', $to);
$email->__set('subject', $subject);
$email->__set('message', $message);

$email->validateMessage();

$PHPMailer = new PHPMailer(true);

$PHPMailer->isSMTP();                        // Diz que vai usar SMTP
$PHPMailer->Host       = 'smtp.gmail.com';   // Servidor SMTP
$PHPMailer->SMTPAuth   = true;               // Habilita autenticação
$PHPMailer->Username   = 'bingbongflipflap5@gmail.com'; 
$PHPMailer->Password   = 'sgxu mvtj vfix ggct';
$PHPMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Segurança (TLS)
$PHPMailer->Port       = 587;                // Porta SMTP

$PHPMailer->isHTML(true); // Define que o corpo é em HTML
$PHPMailer->Subject = $email->subject;
$PHPMailer->Body = $email->message;

$PHPMailer->setFrom('bingbongflipflap5@gmail.com', 'naoeorenaneujuro'); // Remetente
$PHPMailer->addAddress($email->to, 'random'); // Destinatário

try {
    $PHPMailer->send();
    echo "Email enviado com sucesso!";
} catch(Exception $e) {
    echo "Erro!: {$PHPMailer->ErrorInfo}";
}