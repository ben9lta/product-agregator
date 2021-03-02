<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    const TABLE_NAME = 'orders';

    const ATTR_ID            = self::TABLE_NAME . '.id';
    const ATTR_CART_ID       = self::TABLE_NAME . '.cart_id';
    const ATTR_NAME          = self::TABLE_NAME . '.name';
    const ATTR_PHONE         = self::TABLE_NAME . '.phone';
    const ATTR_ADDRESS       = self::TABLE_NAME . '.address';
    const ATTR_DATE_DELIVERY = self::TABLE_NAME . '.date_delivery';
    const ATTR_TIME_DELIVERY = self::TABLE_NAME . '.time_delivery';
    const ATTR_PAY_TYPE      = self::TABLE_NAME . '.pay_type';
    const ATTR_USER_ID       = self::TABLE_NAME . '.user_id';
    const ATTR_TOTAL         = self::TABLE_NAME . '.total';
    const ATTR_COMMENT       = self::TABLE_NAME . '.comment';
    const ATTR_STATUS        = self::TABLE_NAME . '.status';
    const ATTR_DELIVERY_COST = self::TABLE_NAME . '.delivery_cost';

    const STATUS_NO_PAID = 0;
    const STATUS_PAID    = 1;

    const TYPE_CASH   = 0;
    const TYPE_ONLINE = 1;

    public function __construct(array $attributes = [])
    {
        $defaultValues = [
            'pay_type' => self::TYPE_CASH,
            'total' => 0,
            'delivery_cost' => 0,
            'status' => 0,
        ];

        parent::fill($defaultValues);
        parent::__construct($attributes);
    }

    protected $fillable = [
        'user_id',
        'cart_id',
        'name',
        'phone',
        'address',
        'total',
        'comment',
        'status',
        'pay_type',
        'delivery_cost'
    ];
}
