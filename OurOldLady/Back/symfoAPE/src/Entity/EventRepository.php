<?php
namespace App\Repository;
use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function findNext($max_results = 1, $as_array = false)
    {  
        $query = $this->createQueryBuilder('e')
            //->leftJoin('e.author', 'u')
            ->leftJoin('e.medium', 'm')
            ->addSelect('m')
            ->where("e.isPublished = 1")
            ->orderBy('e.date')
            ->setMaxResults($max_results)
            ;
      
        if(empty($as_array)){
            return $query->getQuery()->getResult();
        }else{
            return $query->getQuery()->getArrayResult();
        }
    }
}
