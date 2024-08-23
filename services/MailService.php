<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

class MailService {
    public function sendAccountCreationEmail($email, $username) {
        $mail = new PHPMailer(true);

        try {
            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your_email@example.com';
            $mail->Password = 'your_email_password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Destinataires
            $mail->setFrom('your_email@example.com', 'Zoo Arcadia');
            $mail->addAddress($email);

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = 'Création de votre compte Zoo Arcadia';
            $mail->Body = "Bonjour,<br><br>Votre compte a été créé avec succès. Voici vos informations de connexion :<br>
                        <strong>Nom d'utilisateur :</strong> $username<br><br>
                        Veuillez contacter l'administrateur pour obtenir votre mot de passe.<br><br>
                        Cordialement,<br>L'équipe du Zoo Arcadia";

            // Envoyer l'email
            $mail->send();
        } catch (Exception $e) {
            echo "Le message n'a pas pu être envoyé. Erreur de Mailer: {$mail->ErrorInfo}";
        }
    }
}
