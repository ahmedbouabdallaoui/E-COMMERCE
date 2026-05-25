<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $reg)
    {
        parent::__construct($reg, Category::class);
    }

    /** @return array<int, array{0: Category, productCount: int}> */
    public function findAllWithProductCount(): array
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c, COUNT(p.id) AS productCount
                 FROM App\Entity\Category c
                 LEFT JOIN c.products p
                 GROUP BY c.id'
            )
            ->getResult();
    }
}
