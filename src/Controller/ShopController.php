<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShopController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $repo,
    ) {}

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('shop/index.html.twig', [
            'products' => $this->repo->findAll(),
        ]);
    }

    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('shop/profile.html.twig');
    }
}
