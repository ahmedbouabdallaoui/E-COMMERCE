<?php

namespace App\Service;

use App\DTO\CartItemDTO;
use App\Interface\CartInterface;
use App\Repository\ProductRepository;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class CartHandler
{
    public function __construct(
        #[Autowire(service: SessionCart::class)]
        private CartInterface $cart,
        private ProductRepository $products,
    ) {}

    public function add(int $productId, int $quantity): void
    {
        $this->cart->add($productId, $quantity);
    }

    public function remove(int $productId): void
    {
        $this->cart->remove($productId);
    }

    /** @return CartItemDTO[] */
    public function getItems(): array
    {
        return $this->cart->getItems();
    }

    /** @return CartItemDTO[] */
    public function getEnrichedItems(): array
    {
        return array_map(
            fn(CartItemDTO $item) => new CartItemDTO(
                $item->productId,
                $item->quantity,
                $this->products->find($item->productId),
            ),
            $this->cart->getItems(),
        );
    }

    public function clear(): void
    {
        $this->cart->clear();
    }
}
