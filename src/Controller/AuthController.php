<?php

namespace App\Controller;

use App\Entity\Manager;
use App\Form\ManagerType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{

    public function __construct(private readonly ManagerRegistry $doctrine)
    {
    }

    /**
     * @Route("/manager")
     */
    public function login(Request $request): Response
    {
        $form = $this->createForm(ManagerType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $manager = $this->doctrine
                ->getRepository(Manager::class)
                ->findOneBy(['username' => $data['username']]);

            if (!$manager || !password_verify($data['password'], $manager->getPassword())) {
                $this->addFlash('error', 'Invalid credentials');
            } else {
                $manager->setLoginDate(new \DateTime());
                $entityManager = $this->doctrine->getManager();
                $entityManager->persist($manager);
                $entityManager->flush();
                $this->get('session')->set('manager_id', $manager->getId());
                return $this->redirectToRoute('manager_home');
            }
        }

        return $this->render('auth/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout")
     */
    public function logout(): Response
    {
        $this->get('session')->clear();
        return $this->redirectToRoute('manager_login');
    }
}
