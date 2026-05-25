<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $reg)
    {
        parent::__construct($reg, Product::class);
    }

    public function findByCategory(Category $cat): array
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                 FROM App\Entity\Product p
                 WHERE p.category = :cat'
            )
            ->setParameter('cat', $cat)
            ->getResult();
    }
}
