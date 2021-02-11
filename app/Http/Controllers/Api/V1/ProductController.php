<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Models\Store\Store;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $repository;
    /**
     * @var ProductRepository
     */
    private $products;
    /**
     * @var \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private $categories;
    /**
     * @var \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private $stores;

    public function __construct(ProductRepository $repository,
                                CategoryRepository $categoryRepository,
                                StoreRepository $storeRepository,
                                ProductRepository $productRepository)
    {
        $this->repository = $repository;
        $this->products   = $productRepository;
        $this->categories = $categoryRepository->query()->get(['id', 'name']);
        $this->stores     = $storeRepository->query()->get(['id', 'name']);
    }

    public function index()
    {
        return ProductResource::collection($this->repository->with(['category', 'store'])->paginate(15));
    }

    public function getByCategory($category)
    {
        return ProductResource::collection($this->repository->with(['category', 'store'])
            ->where('category_id', '=', $category)->paginate(15));
    }

    public function filteringProducts(Request $request)
    {
        parse_str($request->all()['data'], $request);
        $stores = $request['stores'] ? array_keys($request['stores']) : null;
        $category_id = (int)$request['category_id'] !== 0 ? $request['category_id'] : null;
        $price_from  = (int)$request['price_from'];
        $price_to    = (int)$request['price_to'];
        $min_price   = 0;
        $max_price   = 10000000;

        if ($price_to < $price_from)
        {
            $price_to = $max_price;
        }
        else if ($price_to === 0)
        {
            $price_to = $max_price;
        }

        $products = $this->products->with(['store', 'category'])
            ->where(Product::ATTR_CATEGORY, $category_id ?? DB::raw(Product::ATTR_CATEGORY))
            ->where(Product::ATTR_PRICE, '>=', $price_from ?? $min_price)
            ->where(Product::ATTR_PRICE, '<', $price_to ?? $max_price);

        if($stores)
        {
            $products->whereIn(Product::ATTR_STORE, $stores);
        }
        else
        {
            $products->where(Product::ATTR_STORE, DB::raw(Product::ATTR_STORE));
        }

        $products = ProductResource::collection($products->paginate(15));
        return $products;
//        return view('frontend.catalog', [
//            'categories' => $this->categories,
//            'stores'     => $this->stores,
//            'products'   => $products
//        ]);
    }

    public function show($id)
    {
        //
    }

}
