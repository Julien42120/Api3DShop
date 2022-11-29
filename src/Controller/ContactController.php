<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact', methods: "POST")]
    public function getPriceConfiguration(MailerInterface $mailer, Request $request): HttpFoundationResponse
    {

        $parameters = json_decode($request->getContent(), true);

        $subject = $parameters['sujet'];
        $text = $parameters['text'];
        $mail = $parameters['mail'];


        if ($subject && $text &&  $mail) {
            $email = (new Email())
                ->from($mail)
                ->to('julienmartin42120@gmail.com')
                ->subject($subject)
                ->html($text);
            $mailer->send($email);
        } else {
            $this->addFlash('error', 'Le formulaire n\'est rempli correctement');
            return $this->redirectToRoute('mail', [], HttpFoundationResponse::HTTP_SEE_OTHER);
        }

        return $this->redirectToRoute('home', [
            $this->addFlash('mail', 'Votre mail a bien été envoyé')
        ], HttpFoundationResponse::HTTP_SEE_OTHER);

        return $this->json([
            'new_price' => 'resultCalcul'
        ]);
    }
}
