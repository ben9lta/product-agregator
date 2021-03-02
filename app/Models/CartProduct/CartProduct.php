<?php

namespace App\Models\CartProduct;

use App\Models\Cart\Cart;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    const TABLE_NAME = 'carts_products';
    protected $table = self::TABLE_NAME;

    const ATTR_ID               = self::TABLE_NAME . '.id';
    const ATTR_CART_ID          = self::TABLE_NAME . '.cart_id';
    const ATTR_PRODUCT_ID       = self::TABLE_NAME . '.product_id';
    const ATTR_QUANTITY         = self::TABLE_NAME . '.quantity';

    public function __construct(array $attributes = [])
    {
        $defaultValues = [
            'quantity' => 1,
        ];

        parent::fill($defaultValues);
        parent::__construct($attributes);
    }

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity'
    ];

    public function products() {
        return $this->hasMany(Product::class,'id', 'product_id');
    }

    public function carts() {
        return $this->hasMany(Cart::class, 'id', 'cart_id');
    }
}
