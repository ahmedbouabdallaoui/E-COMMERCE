<?php

namespace App\Service;

use App\DTO\CartItemDTO;
use App\Interface\CartInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class SessionCart implements CartInterface
{
    private const KEY = 'cart';

    public function __construct(
        private RequestStack $stack,
    ) {}

    public function add(int $productId, int $quantity): void
    {
        $s = $this->stack->getSession();
        $c = $s->get(self::KEY, []);
        $c[$productId] = ($c[$productId] ?? 0) + $quantity;
        $s->set(self::KEY, $c);
    }

    public function remove(int $productId): void
    {
        $s = $this->stack->getSession();
        $c = $s->get(self::KEY, []);
        unset($c[$productId]);
        $s->set(self::KEY, $c);
    }

    public function getItems(): array
    {
        $items = [];
        foreach ($this->stack->getSession()->get(self::KEY, []) as $id => $qty) {
            $items[] = new CartItemDTO($id, $qty);
        }
        return $items;
    }

    public function clear(): void
    {
        $this->stack->getSession()->remove(self::KEY);
    }
}
