<?php

namespace App\Repository;

use App\Entity\PrivatePost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrivatePost|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrivatePost|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrivatePost[]    findAll()
 * @method PrivatePost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrivatePostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrivatePost::class);
    }

}
