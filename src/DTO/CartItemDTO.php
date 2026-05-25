<?php

namespace App\DTO;

use App\Entity\Product;

class CartItemDTO
{
    public function __construct(
        public int $productId,
        public int $quantity,
        public ?Product $product = null,
    ) {}
}
