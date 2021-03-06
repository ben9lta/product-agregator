<?php

namespace App\Models\Store;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    const TABLE_NAME = 'stores';

    const ATTR_ID    = self::TABLE_NAME . '.id';
    const ATTR_NAME  = self::TABLE_NAME . '.name';

    protected $fillable = [
        'name',
        'location',
        'info'
    ];

//    public function products()
//    {
//        $this->hasMany(Product::class, 'id');
//    }

}
