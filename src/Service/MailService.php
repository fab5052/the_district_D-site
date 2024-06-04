<?php 

namespace App\Service;

use App\Entity\Utilisateur;
//use App\Entity\Contact;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;



class MailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    // public function send(
    //     string $from,
    //     string $to,
    //     string $subject,
    //     string $template,
    //     array $context
    // ): void
    
    public function sendEmail(Utilisateur $data): void
    {
          $email = (new TemplatedEmail())
            ->from($data->getEmail())
            ->to('The_District@gmail.com')
            ->subject('Inscription')
            ->htmlTemplate('registration/confirmation_email.html.twig')
            ->context(['data_mail' => $data]);
    
        $this->mailer->send($email);
    }

     public function sendEmailConfirmation(Utilisateur $data): void
    {


        $emailConfirmation = (new Email())
            ->from('The_District@gmail.com')
            ->to($data->getEmail())
            ->subject('Inscription')
            ->text('Merci pour votre inscription.');

        $this->mailer->send($emailConfirmation);
    }

}
 

