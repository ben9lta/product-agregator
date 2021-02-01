<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store\Store;
use App\Repository\StoreRepository;
use App\Services\Store\StoreService;

class StoreController extends Controller
{
    /**
     * @var StoreRepository
     */
    private $repository;
    /**
     * @var StoreService
     */
    private $service;

    public function __construct(StoreService $service, StoreRepository $repository)
    {
        $this->service    = $service;
        $this->repository = $repository;
    }

    public function index()
    {
        $stores = $this->repository->query()->orderBy('id')->paginate(15);;
        return view('admin.store.index', ['stores' => $stores]);
    }

    public function create()
    {
        return view('admin.store.create');
    }

    public function store(StoreRequest $request, Store $store)
    {
        try {
            $store = $this->service->save($request, $store);
            return redirect()->route('stores.show', $store->id);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }

    public function show($id)
    {
        $store = $this->repository->find($id);
        return view('admin.store.show', ['store' => $store]);
    }

    public function edit($id)
    {
        $store = $this->repository->find($id);
        return view('admin.store.edit', ['store' => $store]);
    }

    public function update(StoreRequest $request, Store $store)
    {
        try {
            $store = $this->service->save($request, $store);
            return redirect()->route('stores.show', $store->id);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('stores.index');
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }
}
