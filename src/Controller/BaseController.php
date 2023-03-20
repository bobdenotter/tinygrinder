<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;

class BaseController extends AbstractController
{
    private Security $security;

    private CharacterRepository $characterRepository;

    public function __construct(Security $security, CharacterRepository $characterRepository)
    {
        $this->security = $security;
        $this->characterRepository = $characterRepository;
    }

    public function getActiveCharacter()
    {
        return $this->characterRepository->find($this->security->getUser()->getActiveCharacter());
    }
}
