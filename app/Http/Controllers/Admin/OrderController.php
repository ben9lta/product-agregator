<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
     * @var OrderService
     */
    private $service;

    public function __construct(OrderService $service, OrderRepository $repository)
    {
        $this->service    = $service;
        $this->repository = $repository;
    }

    public function index()
    {
        $orders = $this->repository->query()->orderByDesc('status')->orderByDesc('created_at')->paginate(15);;
        return view('admin.order.index', ['orders' => $orders]);
    }

    public function show($id)
    {
        $order = $this->repository->with('carts.products')->find($id);
        return view('admin.order.show', ['order' => $order]);
    }

    public function active($id, Order $order)
    {
        $order = $this->service->active($id, $order);
        if( !$order ) {
            session()->flash('message', 'Данный заказ уже выбран.');
            return redirect()->back();
        }

        return view('admin.order.show', ['order' => $order]);
    }

}
