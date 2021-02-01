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

//    public function getWithChildren($relations = [], $columns = ['id', 'name', 'parent_id'])
//    {
//        return $this->with( array_merge(['children'], $relations) )->select($columns)->whereNull('parent_id')->get();
//    }

    public function find($id)
    {
        return $this->query()->findOrFail($id);
    }

}
