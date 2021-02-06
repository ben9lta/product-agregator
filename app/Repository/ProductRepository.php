<?php


namespace App\Repository;


use App\Models\Product\Product;

class ProductRepository
{
    /**
     * @var Product
     */
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function query()
    {
        return $this->product::query();
    }

    public function with($relations = [])
    {
        return $this->query()->with($relations);
    }

    public function find($id)
    {
        return $this->query()->findOrFail($id);
    }

    public function findByName($name)
    {
        return $this->query()->where('name', 'LIKE', $name)->first();
    }

}
