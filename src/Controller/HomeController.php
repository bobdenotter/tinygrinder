<?php

namespace App\Controller;

use DiceBag\Dice\Dice;
use DiceBag\DiceBag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $roll = DiceBag::factory('4d6dl1 + 3d8 + 4');
        dump($roll->getTotal());
        dump($roll->getDicePools());


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
