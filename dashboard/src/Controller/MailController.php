<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    private $mailer;

    public function __construct(\Swift_Mailer $swift_Mailer)
    {
        $this->mailer = $swift_Mailer;
    }

    /**
     * @param $token
     * @param $username
     * @param $receiver
     */
    public function send_mail($token, $username, $receiver)
    {
        $mail = (new \Swift_Message())->setFrom('registerdashboard@gmail.com')->setTo($receiver)
        ->setBody(
            $this->renderView('mail/login.html.twig', [
                'token' => $token,
                'username' => $username
            ]), 'text/html'
        );
        $this->mailer->send($mail);
    }
}
