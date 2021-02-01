<?php


namespace App\Services\Store;

use App\Http\Requests\StoreRequest;
use App\Models\Store\Store;
use App\Repository\StoreRepository;

class StoreService
{
    /**
     * @var StoreRepository
     */
    protected $repository;

    public function __construct(StoreRepository $repository)
    {
        $this->repository    = $repository;
    }

    public function save(StoreRequest $request, Store $model)
    {
        try {
            $model->fill($request->all());

            if(!$model->save()) {
                throw new \Exception("Запись не сохранена!");
            }
            return $model;

        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }

    public function delete($id)
    {
        try {
            $model = $this->repository->find($id);
            if(!$model->delete()) {
                throw new \Exception("Произошла ошибка при удалении записи!");
            }
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }
}
