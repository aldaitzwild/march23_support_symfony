<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_full_home')]
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return new Response('Malicieux');
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/hello/thomas', name: 'app_hello_thomas')]
    public function helloThomas(): Response
    {
        return $this->render('home/thomas.html.twig');
    }

    #[Route('/hello/{name}', name: 'app_hello')]
    public function hello(string $name): Response
    {
        return $this->render('home/thomas.html.twig');
    }

    #[Route('/hello/{id}', name: 'app_hello_id')]
    public function helloId(int $id): Response
    {
        return $this->render('home/thomas.html.twig');
    }

    
}
