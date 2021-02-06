<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParserRequest;
use App\Models\Parser\Parser;
use App\Models\ParserOptions\ParserOptions;
use App\Repository\CategoryRepository;
use App\Repository\OptionRepository;
use App\Repository\ParserRepository;
use App\Repository\StoreRepository;
use App\Services\Parser\ParserService;
use Illuminate\Http\Request;

class ParserController extends Controller
{
    /**
     * @var ParserService
     */
    private $service;
    /**
     * @var ParserRepository
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
    /**
     * @var OptionRepository
     */
    private $optionRepository;

    public function __construct(
        ParserService $service,
        ParserRepository $repository,
        CategoryRepository $categoryRepository,
        StoreRepository $storeRepository,
        OptionRepository $optionRepository
    )
    {
        $this->service            = $service;
        $this->repository         = $repository;
        $this->categoryRepository = $categoryRepository;
        $this->storeRepository    = $storeRepository;
        $this->optionRepository   = $optionRepository;
    }

    public function index()
    {
        $parsers = $this->repository->query()->orderBy('id')->paginate(15);
        return view('admin.parser.index', ['parsers' => $parsers]);
    }

    public function create()
    {
        $categories = $this->categoryRepository->query()->get(['id', 'name']);
        $stores     = $this->storeRepository->query()->get(['id', 'name']);
        $options    = $this->optionRepository->query()->get();

        return view('admin.parser.create', [
            'categories' => $categories,
            'stores'     => $stores,
            'options'    => $options,
        ]);
    }

    public function store(ParserRequest $request, Parser $parser)
    {
        try {
            $parser = $this->service->save($request, $parser);
            return redirect()->route('parsers.show', $parser->id);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }

    public function show($id)
    {
        $parser = $this->repository->find($id);
        return view('admin.parser.show', ['parser' => $parser]);
    }

    public function edit($id)
    {
        $categories = $this->categoryRepository->query()->get(['id', 'name']);
        $stores     = $this->storeRepository->query()->get(['id', 'name']);
        $options    = $this->optionRepository->query()->get();
        $parser     = $this->repository->find($id);
        return view('admin.parser.edit', [
            'parser'     => $parser,
            'categories' => $categories,
            'options'    => $options,
            'stores'     => $stores,
        ]);
    }

    public function update(ParserRequest $request, Parser $parser)
    {
        try {
            $parser = $this->service->save($request, $parser);
            return redirect()->route('parsers.show', $parser->id);
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('parsers.index');
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }
    }

    public function settings()
    {
        $parsers = $this->repository->query()->orderBy('id')->paginate(15);
        return view('admin.parser.index', ['parsers' => $parsers]);
    }


    public function parseOne($id)
    {
        $this->service->parseAndSave($id);
        return redirect()->route('products.index');
    }

    public function parseAll()
    {
        $this->service->parseAndSaveAll();
        return redirect()->route('products.index');
    }
}
