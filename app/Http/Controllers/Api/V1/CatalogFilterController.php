<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repository\CategoryRepository;
use App\Repository\StoreRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class CatalogFilterController extends Controller
{
    private $categories;
    private $stores;

    public function __construct(CategoryRepository $categoryRepository,
                                StoreRepository $storeRepository)
    {
        $this->categories = $categoryRepository->query()->get(['id', 'name']);
        $this->stores     = $storeRepository->query()->get(['id', 'name']);
    }

    public function index()
    {
        return JsonResource::collection(['categories' => $this->categories, 'stores' => $this->stores]);
    }

}
