<?php

declare(strict_types=1);

namespace App;

use App\Repository\CreatureRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Yaml\Yaml;

class CreatureImporter
{
    private EntityManager $em;
    private CreatureRepository $repository;

    public function __construct(CreatureRepository $repository, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    public function run()
    {
        $creatures = Yaml::parseFile(__DIR__ . '/../data/creatures/creatures.yaml');

        // Process Encounters
        foreach ($creatures as $creature) {
            $creatureEntity = $this->repository->fromArray($creature);

            $this->em->persist($creatureEntity);
        }

        $this->em->flush();
    }
}
