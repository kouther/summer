<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GenerateCardController extends AbstractController
{
    #[Route('/generate/card', name: 'app_generate_card')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        return $this->render('generate_card/index.html.twig', [
            'user' => '$user',
        ]);
    }
}
