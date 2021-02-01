<?php


namespace App\Repository;


use App\Models\Store\Store;

class StoreRepository
{
    /**
     * @var Store
     */
    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function query()
    {
        return $this->store::query();
    }

    public function find($id)
    {
        return $this->query()->findOrFail($id);
    }

}
