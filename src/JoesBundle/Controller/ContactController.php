<?php

namespace App\JoesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\JoesBundle\Entity\Contact;
use App\JoesBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use ReCaptcha\ReCaptcha;

class ContactController extends AbstractController {

    /**
     * @Route("/contact/index",  methods={"GET"})
     */
    public function index(Request $request, \Swift_Mailer $mailer) {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact, [
            'action' => $this->generateUrl('contact_index')
        ]);

        //Handle form request
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $this->captchaverify($request)) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $this->sendmail($user, $mailer, $msg='Hello');

            $this->addFlash(
                'success', 'Contact was added successfully.'
            );

            return $this->redirectToRoute('contact_index');
        }

        # check if captcha response isn't get throw a message
        if ($form->isSubmitted() && $form->isValid() && !$this->captchaverify($request)) {

            $this->addFlash(
                'error', 'reCaptcha is required'
            );
        }

        return $this->render('@theme/index.html.twig', ['contact_form' => $form->createView(),
                'username' => $user->getUserName()]);
    }
    
    /**
     * Get response from recaptcha
     *  
     * @param type $request
     * @return boolean
     */
    function captchaverify($request) {
        $recaptcha = new ReCaptcha('6LePb4kUAAAAAOMO6piY8FwzHo7eu6A5EVuGnbfY');
        $resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());

        if (!$resp->isSuccess()) {
            // Do something if the submit wasn't valid ! Use the message to show something
            return false;
        } else {
            // Everything works good ;) your contact has been saved.
            return true;
        }
    }

    /**
     * Send email
     * 
     * @param type $user
     * @param type $mailer
     */
    function sendmail($user, $mailer, $msg) {

        $message = (new \Swift_Message($msg))
            ->setFrom($user->getEmail())
            ->setTo($user->getEmail(), 'reggiestain@gmail.com')
            ->setBody(
            $this->renderView(
                '@theme/email.html.twig', array('name' => $user->getUserName())
            ), 'text/html'
        );

        $mailer->send($message);
    }

}
