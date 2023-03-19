<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    public function __construct(private readonly ManagerRegistry $doctrine)
    {
    }

    /**
     * @Route("/app_landing_page")
     */
    public function index(Request $request): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$client->getEmail()) {
                $this->addFlash('error', 'Заполните адрес электронной почты.');
                return $this->redirectToRoute('app_landing_page');
            }

            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            // Redirect to success page or show success message
            return $this->redirectToRoute('success');
        }

        // Form is not valid, display error message
        $errors = $form->getErrors(true, false);
        $errorMessage = '';
        foreach ($errors as $error) {
//            $errorMessage .= (string)$error . "<br>";
            $errorMessage .= "Email заполнен не верно" . "<br>";
        }

        return $this->render('landing/index.html.twig', [
            'form' => $form->createView(),
            'errorMessage' => $errorMessage,
        ]);
    }

    /**
     * @Route("/success")
     */
    public function success(): Response
    {
        return $this->render('landing/success.html.twig', []);
    }
}