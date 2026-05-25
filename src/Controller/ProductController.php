<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\CartHandler;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $repo,
        private readonly CartHandler $cart,
    ) {}

    #[Route('/products', name: 'app_products')]
    public function index(): Response
    {
        return $this->render('products/index.html.twig', [
            'products' => $this->repo->findAll(),
        ]);
    }

    #[Route('/product/{id}', name: 'app_product')]
    public function show(Product $product): Response
    {
        return $this->render('products/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/product/{id}/add-to-cart', name: 'cart_add', methods: ['POST'])]
    public function addToCart(Product $product, Request $request): Response
    {
        $qty = (int) $request->request->get('quantity', 1);
        $this->cart->add($product->getId(), $qty < 1 ? 1 : $qty);

        return $this->redirectToRoute('cart_index');
    }
}
