<?php


namespace App\Services\CartProduct;


use App\Http\Requests\CartProductRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\ProductResource;
use App\Models\Cart\Cart;
use App\Models\CartProduct\CartProduct;
use App\Repository\CartProductRepository;
use App\Repository\ProductRepository;
use App\Services\Cart\CartService;

class CartProductService
{
    /**
     * @var CartProductRepository
     */
    protected $repository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(CartProductRepository $repository, ProductRepository $productRepository)
    {
        $this->repository        = $repository;
        $this->productRepository = $productRepository;
    }

    private function getCartByRequest(CartProductRequest $request)
    {
        if( !empty($request->post('user_id')) ) {
            $cart = Cart::query()
                ->where(['user_id' => $request->post('user_id')])
                ->where('status', Cart::STATUS_ACTIVE)
                ->first();
        } else {
            $cart = Cart::query()
                ->where(['session' => $request->post('session')])
                ->where('status', Cart::STATUS_ACTIVE)
                ->first();
        }

        return $cart;
    }

    private function getModelByRequest(CartProductRequest $request, CartProduct $model)
    {
        $cart = $this->getCartByRequest($request);
        return $model::query()->firstOrNew([
            'cart_id' => $cart['id'],
            'product_id' => $request->post('product_id'),
        ]);
    }

    public function save(CartProductRequest $request, CartProduct $model)
    {
        try {
            $model = $this->getModelByRequest($request, $model);
            $cart = $this->getCartByRequest($request);

            if($model->exists) {
                return false;
            }

            $product = $this->productRepository->find($request->post('product_id'));
            $cart->total += ($product->price * $model->quantity);
            if(!$model->save()) {
                throw new \Exception("Запись не сохранена!");
            }
            $cart->save();
            return $model;

        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }

    private function updateTotal(CartProductRequest $request)
    {
        $cart = $this->getCartByRequest($request);
        $cartResource = new CartResource($cart->with('products')->find($cart->id));
        $products = $cartResource->products;
        $total = 0;
        foreach ($products as $product) {
            $total += $product->price * (int)$product->pivot->quantity;
        }

        $cart->total = $total;
        $cart->save();
    }

    public function updateQuantity(CartProductRequest $request, CartProduct $model)
    {
        try {
            $model = $this->getModelByRequest($request, $model);
            $model->quantity = $request->post('quantity');

            if(!$model->save()) {
                throw new \Exception("Запись не сохранена!");
            }

            $this->updateTotal($request);

            return $model;

        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }

    public function delete(CartProductRequest $request, CartProduct $model)
    {
        try {
            $model = $this->getModelByRequest($request, $model);
            $cart = $this->getCartByRequest($request);

            $product = $this->productRepository->find($request->post('product_id'));
            $cart->total -= ($product->price * $model->quantity);

            if(!$model->delete()) {
                throw new \Exception("Произошла ошибка при удалении записи!");
            }
            $cart->save();

        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }
}
