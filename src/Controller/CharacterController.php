<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Character;
use App\Form\CharacterType;
use App\Repository\CharacterRepository;
use DiceBag\DiceBag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends AbstractController
{
    private Security $security;

    private EntityManagerInterface $entityManager;

    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    #[Route('/character', name: 'character_list')]
    public function index(CharacterRepository $characterRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $characters = $characterRepository->findBy(['user' => $user]);

        return $this->render('character/index.html.twig', [
            'characters' => $characters,
        ]);
    }

    #[Route('/character/new', name: 'character_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $character = new Character();
        $character->setUser($this->security->getUser());

        $this->rollAttributes($character);

        $form = $this->createForm(CharacterType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($character);
            $this->entityManager->flush();

            return $this->redirectToRoute('character_list');
        }

        return $this->render('character/new.html.twig', [
            'character' => $character,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/character/{id}/delete', name: 'character_delete', methods: ['POST'])]
    public function delete(Request $request, Character $character): Response
    {
        if ($this->isCsrfTokenValid('delete' . $character->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($character);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('character_list');
    }

    #[Route('/character/{id}', name: 'character_detail', methods: ['GET'])]
    public function detail(Character $character, Request $request): Response
    {
        // Set the active character for the current user
        $user = $this->getUser();
        $user->setActiveCharacter($character);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->render('character/detail.html.twig', [
            'character' => $character,
        ]);
    }

    private function rollAttributes(Character $character): void
    {
        $character->setHitpoints(DiceBag::factory('2d6')->getTotal());
        $modifier = [
            2 => -2,
            3 => -2,
            4 => -1,
            5 => -1,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 1,
            10 => 1,
            11 => 2,
            12 => 2];
        $character->setSkillBonus($modifier[DiceBag::factory('2d6')->getTotal()]);
        $character->setArmorClass($modifier[DiceBag::factory('2d6')->getTotal()]);
        $character->setAttack($modifier[DiceBag::factory('2d6')->getTotal()]);
    }
}
