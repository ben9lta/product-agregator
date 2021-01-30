<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category\Category;
use App\Repository\CategoryRepository;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;
    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct(CategoryService $service, CategoryRepository $repository)
    {
        $this->categoryService = $service;
        $this->repository      = $repository;
    }

    public function index()
    {
        $categories = $this->repository->query()
            ->whereNull('parent_id')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.category.index', ['categories' => $categories]);
    }

    public function create()
    {
        $categories = $this->repository->getWithChildren();
        return view('admin.category.create', ['categories' => $categories]);
    }

    public function store(CategoryRequest $request, Category $category)
    {
        try {
            $category = $this->categoryService->save($request, $category);
            return redirect()->route('categories.show',  $category->id);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }

    public function show($id)
    {
        $category = $this->repository->query()->findOrFail($id);
        return view('admin.category.show', ['category' => $category]);
    }

    public function edit($id)
    {
        $category = $this->repository->query()->findOrFail($id);
        $categories = $this->repository->getWithChildren();

        return view('admin.category.edit', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category = $this->categoryService->save($request, $category);
            return redirect()->route('categories.show',  $category->id);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }

    public function destroy($id)
    {
        try {
            $this->categoryService->delete($id);
            return redirect()->route('categories.index');
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }
}
