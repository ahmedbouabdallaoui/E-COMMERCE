<?php

namespace App\Exception;

class CartException extends \RuntimeException
{
    public static function productNotFound(int $productId): self
    {
        return new static(sprintf('product %d is not in your cart', $productId));
    }

    public static function invalidQuantity(): self
    {
        return new static('quantity shoud be more than zero');
    }
}
