<?php

namespace App\Interface;

interface CartInterface
{
    public function add(int $productId, int $quantity): void;
    public function remove(int $productId): void;

    /** @return \App\DTO\CartItemDTO[] */
    public function getItems(): array;

    public function clear(): void;
}
