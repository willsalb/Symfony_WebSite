<?php

namespace App\Service;
use Symfony\Component\Mailer\MailerInterface;
use App\Service\ContactForm;
use App\Form\ContactFormType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\ValueObject;

// declare(strict_types=1);

class EmailSender
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /** 
     * @param ContactForm $contactForm
     * 
     * @throws TransportExceptionInterface
     */
    public function sendContactUsForm(ContactFormType $contactForm): void
    {
        $email = (new TemplatedEmail())
        ->to('willamssouza917@gmail.com')
        ->from('contactus@will-coding.com')
        ->subject('New message!')
        ->htmlTemplate('emails/contact-form.html.twig')
        #Variaveis que estarão dentro do template
        ->context([
            'name' => $contactForm->name,
            'customer_email' => $contactForm->email,
            'subject' => $contactForm->subject,
            'message' => $contactForm->message,
        ]);

        $this->mailer->send($email);
    }
}