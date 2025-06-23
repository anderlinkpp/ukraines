<?php

namespace App\Mailer;

use App\Entity\Utilisateurs;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class ValidationMailer
{
    private MailerInterface $mailer;
    private Environment $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendValidationEmail(Utilisateurs $utilisateur): void
    {
        $email = (new Email())
            ->from('geraldine.helle@gmail.com')
            ->to($utilisateur->getEmail())
            ->subject('Validation de compte')
            ->html($this->twig->render('validation/validation.html.twig', [
                'email' => $utilisateur->getEmail(),
                'token' => $utilisateur->getToken(),
            ]));

        $this->mailer->send($email);
    }

    
}
