<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart\Cart;
use App\Repository\CartRepository;
use App\Services\Cart\CartService;
use Illuminate\Http\Resources\Json\JsonResource;

class CartController extends Controller
{
    /**
     * @var CartRepository
     */
    private $repository;
    /**
     * @var CartService
     */
    private $service;

    public function __construct(CartRepository $repository,
                                CartService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(CartRequest $request)
    {
        $cart = $this->service->get($request);
        return new CartResource($cart);
    }

    public function store(CartRequest $request, Cart $cart)
    {
        try {
            $cart = $this->service->save($request, $cart);
            return new CartResource($cart);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }

}
