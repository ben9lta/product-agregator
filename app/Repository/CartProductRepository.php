<?php


namespace App\Repository;

use App\Models\CartProduct\CartProduct;

class CartProductRepository
{
    /**
     * @var CartProduct
     */
    private $cartProduct;

    public function __construct(CartProduct $cartProduct)
    {
        $this->cartProduct = $cartProduct;
    }

    public function query()
    {
        return $this->cartProduct::query();
    }

    public function with($relations = [])
    {
        return $this->query()->with($relations);
    }

    public function find($id)
    {
        return $this->query()->findOrFail($id);
    }

}
