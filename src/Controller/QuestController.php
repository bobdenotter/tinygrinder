<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestController extends AbstractController
{
    #[Route('/quest', name: 'app_quest')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        return $this->render('quest/index.html.twig', [
            'controller_name' => 'QuestController',
        ]);
    }
}
