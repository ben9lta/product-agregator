<?php


namespace App\Services\Cart;

use App\Http\Requests\CartRequest;
use App\Models\Cart\Cart;
use App\Repository\CartRepository;


class CartService
{
    /**
     * @var CartRepository
     */
    protected $repository;

    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }

    public function save(CartRequest $request, Cart $model)
    {
        try {
            if( !empty($request->post('user_id')) ) {
                $model = $model::query()
                    ->where(['user_id' => $request->post('user_id')])
                    ->where('status', Cart::STATUS_ACTIVE)
                    ->first();

                if( empty($model) ) {
                    $model = Cart::query()
                        ->where(['session' => $request->post('session')])
                        ->where('status', Cart::STATUS_ACTIVE)
                        ->firstOrNew();
                    $model->session = $request->post('session');
                }

                $model->user_id = $request->post('user_id');
                $model->save();
                return $model;
            } else {
                $model = $model::query()
                    ->where(['session' => $request->post('session')])
                    ->where('status', Cart::STATUS_ACTIVE)
                    ->firstOrNew();
            }

            if($model->exists) {
                return $model;
            }

            $model->fill($request->all());

            if(!$model->save()) {
                throw new \Exception("Запись не сохранена!");
            }

            return $model;

        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }

    public function get(CartRequest $request)
    {
        if( !empty($request->post('user_id')) ) {
            $cart = $this->repository->with('products')
                ->where('user_id', $request->post('user_id'))
                ->where('status', Cart::STATUS_ACTIVE)
                ->first();
        } else {
            $cart = $this->repository->with('products')
                ->where('session', $request->post('session'))
                ->where('status', Cart::STATUS_ACTIVE)
                ->first();
        }
        return $cart;
    }

    public function getBySession($session)
    {
        $cart = $this->repository->with('products')
            ->where('session', $session)
            ->where('status', Cart::STATUS_ACTIVE)
            ->first();
        return $cart;
    }

    public function delete($id)
    {
        try {
            $cart = $this->repository->find($id);
            if(!$cart->delete()) {
                throw new \Exception("Произошла ошибка при удалении записи!");
            }
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }
}
