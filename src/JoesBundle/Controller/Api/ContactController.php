<?php

namespace App\JoesBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\JoesBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ContactController extends AbstractController {

    /**
     * @Route("api/contact/create",  methods={"POST"})
     */
    public function create(Request $request, ValidatorInterface $validator) {

        $contact = new Contact();
        $contact->setFirstname($request->get('firstname'));
        $contact->setSurname($request->get('surname'));
        $contact->setMobile($request->get('mobile'));

        $errors = $validator->validate($contact);

        if (count($errors) > 0) {
            return new JsonResponse(['status' => Response::HTTP_NOT_ACCEPTABLE]);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($contact);
        $em->flush();
        return new JsonResponse(['status' => Response::HTTP_CREATED]);
    }

}
