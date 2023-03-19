<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/new-request")
     */
    public function newRequest(): Response
    {
        return $this->redirectToRoute('app_landing_page');
    }

    /**
     * @Route("/login")
     */
    public function login(): Response
    {
        return $this->redirectToRoute('manager_login');
    }
}
