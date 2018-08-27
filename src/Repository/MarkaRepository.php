<?php

namespace App\Repository;

use App\Entity\Marka;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Marka|null find($id, $lockMode = null, $lockVersion = null)
 * @method Marka|null findOneBy(array $criteria, array $orderBy = null)
 * @method Marka[]    findAll()
 * @method Marka[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarkaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Marka::class);
    }
}
