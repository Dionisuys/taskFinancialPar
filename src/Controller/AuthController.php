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
     * @Route("/manager_login")
     */
    public function login(Request $request): Response
    {
        $form = $this->createForm(ManagerType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $form->getData();

            $managerEntity = $this->doctrine
                ->getRepository(Manager::class)
                ->findOneBy(['username' => $manager->getUsername()]);

            if (!$managerEntity /*|| !password_verify($manager->getPassword(), $managerEntity->getPassword())*/) {
                $this->addFlash('error', 'Менеджера с таким логином и паролем не существует');
            } else {
                $managerEntity->setLoginDate(new \DateTime());
                $entityManager = $this->doctrine->getManager();
                $entityManager->persist($managerEntity);
                $entityManager->flush();
                $request->getSession()->set('manager_id', $manager->getId());
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
    public function logout(Request $request): Response
    {
        if ($request->getSession()->isStarted()) {
            $request->getSession()->clear();
        }

        return $this->redirectToRoute('manager_login');
    }
}
