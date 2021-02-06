<?php


namespace App\Models\Parser;


class DtoProductParser
{
    public $name;
    public $description;
    public $img;
    public $price;
    public $old_price;
    public $count;
    public $category_id;
    public $store_id;

    public function __construct($model)
    {
        $this->name        = $model->option->name;
        $this->description = $model->option->description;
        $this->img         = $model->option->img;
        $this->price       = $model->option->price;
        $this->old_price   = $model->option->old_price;
        $this->count       = $model->option->count;
        $this->category_id = $model->category_id;
        $this->store_id    = $model->store_id;
    }

}
