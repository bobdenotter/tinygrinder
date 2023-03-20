<?php

declare(strict_types=1);

namespace App\Controller;

use DiceBag\DiceBag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $roll = DiceBag::factory('4d6dl1 + 3d8 + 4');
        dump($roll->getTotal());
        dump($roll->getDicePools());

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'character' => $this->getActiveCharacter(),
        ]);
    }
}
