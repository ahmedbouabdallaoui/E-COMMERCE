<?php

namespace App\Service;

use App\Interface\CartInterface;

class ApiCart implements CartInterface
{
    public function add(int $productId, int $quantity): void
    {
        dd(['from' => 'ApiCart::add', 'id' => $productId, 'qty' => $quantity]);
    }

    public function remove(int $productId): void
    {
        dd(['from' => 'ApiCart::remove', 'id' => $productId]);
    }

    public function getItems(): array
    {
        dd(['from' => 'ApiCart::getItems']);
    }

    public function clear(): void
    {
        dd(['from' => 'ApiCart::clear']);
    }
}
