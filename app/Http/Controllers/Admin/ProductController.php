<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $service;
    /**
     * @var ProductRepository
     */
    private $repository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var StoreRepository
     */
    private $storeRepository;

    public function __construct(
        ProductService $service,
        ProductRepository $repository,
        CategoryRepository $categoryRepository,
        StoreRepository $storeRepository
    )
    {
        $this->service            = $service;
        $this->repository         = $repository;
        $this->categoryRepository = $categoryRepository;
        $this->storeRepository    = $storeRepository;
    }

    public function index()
    {
        $products = $this->repository->query()->orderBy('id', 'desc')->paginate(15);
        return view('admin.product.index', ['products'   => $products]);
    }

    public function create()
    {
        $categories = $this->categoryRepository->query()->get(['id', 'name']);
        $stores     = $this->storeRepository->query()->get(['id', 'name']);
        return view('admin.product.create', [
            'categories' => $categories,
            'stores'     => $stores,
        ]);
    }

    public function store(ProductRequest $request, Product $product)
    {
        try {
            $product = $this->service->save($request, $product);
            return redirect()->route('products.show', $product->id);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }

    public function show($id)
    {
        $product    = $this->repository->find($id);
        return view('admin.product.show', ['product' => $product]);
    }

    public function edit($id)
    {
        $categories = $this->categoryRepository->query()->get(['id', 'name']);
        $stores     = $this->storeRepository->query()->get(['id', 'name']);
        $product    = $this->repository->find($id);
        return view('admin.product.edit', [
            'product'    => $product,
            'categories' => $categories,
            'stores'     => $stores,
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product = $this->service->save($request, $product);
            return redirect()->route('products.show', $product->id);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('products.index');
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }
}
