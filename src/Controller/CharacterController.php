<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends AbstractController
{

    public function __construct()
    {
    }

    #[Route('/character', name: 'app_character')]
    public function index(): Response
    {
        return $this->render('character/index.html.twig', [
            'controller_name' => 'CharacterController',
            'characters' => $this->getUser()->getCharacters()
        ]);
    }

    #[Route('/character/create', name: 'app_character_create')]
    public function create(): Response
    {
        

        return $this->render('character/index.html.twig', [
            'controller_name' => 'CharacterCreate',
            'characters' => $this->getUser()->getCharacters()
        ]);
    }
}
