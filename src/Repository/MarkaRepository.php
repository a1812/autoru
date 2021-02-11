<?php

namespace App\Repository;

use App\Entity\Marka;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Marka|null find($id, $lockMode = null, $lockVersion = null)
 * @method Marka|null findOneBy(array $criteria, array $orderBy = null)
 * @method Marka[]    findAll()
 * @method Marka[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarkaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Marka::class);
    }
}
