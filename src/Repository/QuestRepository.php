<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Quest;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Quest>
 *
 * @method Quest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quest[]    findAll()
 * @method Quest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quest::class);
    }

    public function save(Quest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Quest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function fromArray(array $data): Quest
    {
        $slug = Slugify::create()->slugify($data['title']);

        $quest = $this->findOneBy(['slug' => $slug]) ?? new Quest();

        $quest
            ->setTitle($data['title'])
            ->setIntroduction($data['introduction'])
            ->setTravel($data['travel'])
            ->setLocation($data['location'])
            ->setWrapup($data['wrapup'])
            ->setNumberOfEncounters($data['number_of_encounters'])
            ->setGold($data['loot']['gold'])
            ->setTreasure((array) $data['loot']['treasure'])
            ->setCR($data['cr']);

        return $quest;
    }

//    /**
//     * @return Quest[] Returns an array of Quest objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Quest
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
