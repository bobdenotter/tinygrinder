<?php

namespace App\Controller;

use App\Entity\Character;
use App\Enum\CharacterClass;
use App\Form\CharacterType;
use App\Form\NewCharacterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/character', name: 'app_character')]
    public function index(CharacterRepository $characterRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $characters = $characterRepository->findBy(['user' => $user]);

        return $this->render('character/list.html.twig', [
            'characters' => $characters,
        ]);
    }

    #[Route('/character/create', name: 'app_character_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CharacterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $character = new Character();
            $character->setRace($form->getData()['race']->value);
            $character->setName($form->getData()['name']);
            $character->setClass($form->getData()['class']->value);
            $character->setUser($this->security->getUser());

            $entityManager->persist($character);
            $entityManager->flush();

            // Redirect to the next step, such as the game dashboard
            return $this->redirectToRoute('app_character');
        }

        return $this->render('character/create.html.twig', [
            'form' => $form->createView(),
            'characters' => $this->getUser()->getCharacters()
        ]);
    }
}
