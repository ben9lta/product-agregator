<?php

namespace App\Models\Cart;

use App\Models\CartProduct\CartProduct;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    const TABLE_NAME = 'carts';

    const SESSION_KEY = '_token';
    const ATTR_ID        = self::TABLE_NAME . '.id';
    const ATTR_TOTAL     = self::TABLE_NAME . '.total';
    const ATTR_USER_ID   = self::TABLE_NAME . '.user_id';
    const ATTR_SESSION   = self::TABLE_NAME . '.session';
    const ATTR_STATUS    = self::TABLE_NAME . '.status';

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;

    public function __construct(array $attributes = [])
    {
        $defaultValues = ['total' => 0];

        parent::fill($defaultValues);
        parent::__construct($attributes);
    }

    protected $fillable = [
        'session',
        'total'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, CartProduct::TABLE_NAME)
            ->withPivot('quantity');
    }
}
