<?php


namespace App\Services\Order;


use App\Http\Requests\OrderRequest;
use App\Models\Cart\Cart;
use App\Models\Order\Order;
use App\Repository\CartRepository;
use App\Repository\OrderRepository;
use App\User;

class OrderService
{
    /**
     * @var OrderRepository
     */
    protected $repository;
    /**
     * @var CartRepository
     */
    private $cartRepository;

    public function __construct(OrderRepository $repository,
                                CartRepository $cartRepository)
    {
        $this->repository = $repository;
        $this->cartRepository = $cartRepository;
    }

    public function save(OrderRequest $request, Order $model)
    {
        try {
            if( !empty($request->post('user_id')) )
            {
                $cart = $this->cartRepository->query()
                    ->where(['user_id' => $request->post('user_id')])
                    ->where('status', Cart::STATUS_ACTIVE)
                    ->first();
            }
            else
            {
                $cart = $this->cartRepository->query()
                    ->where(['session' => $request->post('session')])
                    ->where('status', Cart::STATUS_ACTIVE)
                    ->first();
            }

            if($cart->total < 1 || $cart->status === 0)
            {
                return false;
            }

            $user = User::query()->find($request->post('user_id')) ?? new User();


            $attributesArray = array_merge(
                $request->all(),
                $user->getAttributes(),
                $cart->getAttributes(),
                ['cart_id' => $cart->id],
                ['user_id' => $user->id]
            );

            $model->fill($attributesArray);

            if(!$model->save()) {
                throw new \Exception("Запись не сохранена!");
            }

            $cart->user_id = $model->user_id;
            $cart->status = Cart::STATUS_INACTIVE;
            $cart->save();

            return $model;

        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

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

    public function active($id, Order $model)
    {
        try {
            $order = $this->repository->find($id);
            if($order->status !== $model::STATUS_WAITING) {
                return false;
            }

            $order->status = $model::STATUS_CHOSEN;
            if(!$order->save()) {
                throw new \Exception("Произошла ошибка при изменении статуса заказа!");
            }

            return $order;

        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }
}
