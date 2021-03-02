<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartProductRequest;
use App\Models\CartProduct\CartProduct;
use App\Repository\CartProductRepository;
use App\Services\CartProduct\CartProductService;
use Illuminate\Http\Resources\Json\JsonResource;

class CartProductController extends Controller
{
    /**
     * @var CartProductRepository
     */
    private $repository;
    /**
     * @var CartProductService
     */
    private $service;

    public function __construct(CartProductRepository $repository,
                                CartProductService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        return JsonResource::collection($this->repository->query()->get());
    }

    public function store(CartProductRequest $request, CartProduct $cartProduct)
    {
        try {
            $result = $this->service->save($request, $cartProduct);
            return $result
                ? ['message' => 'Товар добавлен в корзину']
                : ['message' => 'Данный товар уже в корзине'];
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }

    public function updateQuantity(CartProductRequest $request, CartProduct $cartProduct)
    {
        try {
            $this->service->updateQuantity($request, $cartProduct);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }

    public function delete(CartProductRequest $request, CartProduct $cartProduct)
    {
        try {
            $this->service->delete($request, $cartProduct);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }

}
