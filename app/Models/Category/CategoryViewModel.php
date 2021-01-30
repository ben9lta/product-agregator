<?php


namespace App\Models\Category;


class CategoryViewModel
{

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $img;
    /**
     * @var string
     */
    private $icon;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $slug;
    /**
     * @var int
     */
    private $parent_id;
    /**
     * @var array
     */
    private $child;

    public function __construct(Category $category)
    {
        $this->id        = $category->id;
        $this->icon      = $category->icon;
        $this->img       = $category->img;
        $this->name      = $category->name;
        $this->slug      = $category->slug;
        $this->parent_id = $category->parent_id;

        foreach ($category->children as $category) {
            $child[] = new self($category);
        }

        $this->child = $child ?? [];
    }

}
