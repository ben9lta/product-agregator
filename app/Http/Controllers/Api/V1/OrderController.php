<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order\Order;
use App\Repository\OrderRepository;
use App\Services\Order\OrderService;


class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $repository;
    /**
     * @var OrderRepository
     */
    private $service;

    public function __construct(OrderRepository $repository,
                                OrderService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(OrderRequest $request)
    {
        $order = $this->service->getBySession($request->post('session'));
    }

    public function store(OrderRequest $request, Order $order)
    {
        try {
            $order = $this->service->save($request, $order);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }

}
