<?php

namespace OC\WestoryBundle\Email;

use OC\WestoryBundle\Entity\Members;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;

class MemberMailer extends \Twig_Extension{
    /**
    * @var \Swift_Mailer
    */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig){
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendMail(Members $member){
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom("infos.ocnv@gmail.com")
            ->setTo($member->getEmailAddress())
            ->setBody(
                $this->twig->render(
                    '@OCWestory/emails/registration.html.twig',
                    array('name' => $member->getUsername())
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }
}
