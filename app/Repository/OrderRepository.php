<?php


namespace App\Repository;

use App\Models\Order\Order;

class OrderRepository
{
    /**
     * @var Order
     */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function query()
    {
        return $this->order::query();
    }

    public function with($relations = [])
    {
        return $this->query()->with($relations);
    }

    public function find($id)
    {
        return $this->query()->findOrFail($id);
    }

}
