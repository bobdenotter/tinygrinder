<?php

declare(strict_types=1);

namespace App;

use App\Repository\EncounterRepository;
use App\Repository\QuestRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

class QuestImporter
{
    private EncounterRepository $encounterRepository;

    private QuestRepository $questRepository;

    private EntityManager $em;

    public function __construct(EncounterRepository $encounterRepository, QuestRepository $questRepository, EntityManagerInterface $em)
    {
        $this->encounterRepository = $encounterRepository;
        $this->questRepository = $questRepository;
        $this->em = $em;
    }

    public function run()
    {
        $finder = new Finder();
        $files = $finder->files()->in(__DIR__ . '/../data/quests/');

        foreach ($finder as $file) {
            $quest = Yaml::parseFile($file->getRealPath());

            dump($quest['title']);

            $questEntity = $this->questRepository->fromArray($quest);

            // Process Encounters
            foreach ($quest['encounters'] as $encounter) {
                $encounterEntity = $this->encounterRepository->fromArray($encounter);

                $questEntity->addEncounter($encounterEntity);

                $this->em->persist($encounterEntity);

                //                dump($encounterEntity);
            }

            $this->em->persist($questEntity);
            $this->em->flush();
        }
    }
}
