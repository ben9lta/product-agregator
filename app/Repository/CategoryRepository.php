<?php


namespace App\Repository;


use App\Models\Category\Category;

class CategoryRepository
{
    /**
     * @var Category
     */
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function query()
    {
        return $this->category::query();
    }

    public function with($relations = [])
    {
        return $this->query()->with($relations);
    }

    public function getWithChildren($relations = [], $columns = ['id', 'name', 'parent_id'])
    {
        return $this->with( array_merge(['children'], $relations) )->select($columns)->whereNull('parent_id')->get();
    }

    public function find($id)
    {
        return $this->query()->findOrFail($id);
    }

}
