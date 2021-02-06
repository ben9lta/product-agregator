<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Models\Store\Store;
use App\User;

class AdminController extends Controller
{

    public function index()
    {
        $users      = User::query()->count();
        $products   = Product::query()->count();
        $categories = Category::query()->count();
        $stores     = Store::query()->count();
        return view('admin.dashboard.index', [
            'users'      => $users,
            'products'   => $products,
            'categories' => $categories,
            'stores'     => $stores,
        ]);
    }

}
