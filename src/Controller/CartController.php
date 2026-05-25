<?php

namespace App\Controller;

use App\Service\CartHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart_index')]
    public function index(CartHandler $handler): Response
    {
        return $this->render('cart/index.html.twig', [
            'items' => $handler->getEnrichedItems(),
        ]);
    }

    #[Route('/cart/remove/{productId}', name: 'cart_remove', methods: ['POST'])]
    public function remove(int $productId, CartHandler $handler): Response
    {
        $handler->remove($productId);

        return $this->redirectToRoute('cart_index');
    }
}
