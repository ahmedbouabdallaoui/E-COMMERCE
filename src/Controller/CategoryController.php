<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    public function __construct(
        private readonly CategoryRepository $cats,
        private readonly ProductRepository $prods,
    ) {}

    #[Route('/categories', name: 'app_categories')]
    public function index(): Response
    {
        return $this->render('categories/index.html.twig', [
            'categories' => $this->cats->findAllWithProductCount(),
        ]);
    }

    #[Route('/category/{id}/products', name: 'app_category_products')]
    public function products(Category $category): Response
    {
        return $this->render('categories/products.html.twig', [
            'category' => $category,
            'products' => $this->prods->findByCategory($category),
        ]);
    }
}
