<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactFormType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Psr\Log;
use App\Service\EmailSender;
use App\Service\ContactForm;

class ContactUsController extends AbstractController
{
	#[Route('contact-us', name: 'contactus', methods: ['POST'])]
	public function index(Request $request, MailerInterface $mailer, LoggerInterface $logger): Response
	{
		$form = $this->createForm(ContactFormType::class);

		$form->handleRequest($request);

		$successMessage = null;

		#Validação para obter os dados enviados do formulário
		if($form->isSubmitted() && $form->isValid()) {
			/** @var ContactForm $contactForm */
			$contactForm = $form->getData();

			#TemplatedEmail adiciona metodos para o twigTemplate
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
			
			#Chamando o sendContactUsForm do servico emailsender e passando o objValue contactForm
			try {
				$mailer->send($email);
				
				$successMessage = 'Message was successfully sent!!';

			} catch(TransportExceptionInterface $exception) {
				$form->addError(new FormError('Could not send the request'));
				$logger->error('It was a problem sending email', [
					#Passando o contexto com a menssagem de error original
					'error' => $exception->getMessage(),
				]);
			}
		}

		return $this->renderForm('widget/contact_us.twig', [
			'form' => $form,
			'successMessage' => $successMessage,
		]);
	}
}