<?php

namespace App\Models\Product;

use App\Models\Category\Category;
use App\Models\Store\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use SoftDeletes;
    use Sluggable;

    const TABLE_NAME = 'products';

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE   = 1;

    protected $fillable = [
        'name',
        'description',
        'price',
        'old_price',
        'count',
        'status',
        'category_id',
        'store_id',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public static function getStatusVariants()
    {
        return [
            static::STATUS_ACTIVE   => 'Активен',
            static::STATUS_INACTIVE => 'Неактивен',
        ];
    }

    public function getImgUrl()
    {
        return $this->img ? url('storage/' . $this->img) : asset('admin_assets/img/no_image.png');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }


}
