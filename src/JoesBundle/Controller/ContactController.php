<?php

namespace App\JoesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\JoesBundle\Entity\Contact;
use App\JoesBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController {

    /**
     * @Route("/contact/index",  methods={"GET"})
     */
    public function index(Request $request) {
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
        
        if ($form->isSubmitted() && $form->isValid() && $this->captchaverify($request->get('g-recaptcha-response'))) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $this->addFlash(
                    'notice', 'Todo Added'
            );
            
           return $this->redirectToRoute('contact_index');
        }

        return $this->render('@theme/index.html.twig', ['contact_form' => $form->createView(),
                    'username' => $user->getUserName()]);
    }

    # get success response from recaptcha and return it to controller

    function captchaverify($recaptcha) {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            "secret" => "6LePb4kUAAAAAOMO6piY8FwzHo7eu6A5EVuGnbfY", "response" => $recaptcha));
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);

        if($data->success == false){
           return  'Invalid Captcha,Please try again.';
        }
        
        return $data->success;
    }

}
