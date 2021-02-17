<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class CatalogProductController extends Controller
{
    private $categories;
    private $stores;
    private $products;

    public function __construct(CategoryRepository $categoryRepository,
                                StoreRepository $storeRepository,
                                ProductRepository $productRepository)
    {
        $this->categories = $categoryRepository->query()->get(['id', 'name']);
        $this->stores = $storeRepository->query()->get(['id', 'name']);
        $this->products = $productRepository;
    }

    public function index(Request $request)
    {
        $stores = $request['stores'] ? array_keys($request['stores']) : null;
        $category_id = (int)$request['category'] !== 0 ? $request['category'] : null;
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
            ->orderByDesc('id')
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

        return JsonResource::collection($products->paginate(16)->appends($request->all()));
    }

}
