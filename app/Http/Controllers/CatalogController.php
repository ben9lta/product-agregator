<?php


namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{

    /**
     * @var \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private $categories;
    /**
     * @var \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private $stores;
    /**
     * @var ProductRepository
     */
    private $products;

    public function __construct(CategoryRepository $categoryRepository,
                                StoreRepository $storeRepository,
                                ProductRepository $productRepository)
    {
        $this->categories = $categoryRepository->query()->get(['id', 'name']);
        $this->stores     = $storeRepository->query()->get(['id', 'name']);
        $this->products   = $productRepository;
    }

    public function index()
    {
        return view('frontend.catalog', [
            'categories' => $this->categories,
            'stores'     => $this->stores,
        ]);
    }

    public function byCategory($id)
    {
        return view('frontend.catalog', [
            'category'   => $id,
            'categories' => $this->categories,
            'stores'     => $this->stores
        ]);
    }

}
