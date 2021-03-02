<?php


namespace App\Services\Parser;


use App\Contracts\FileUpload;
use App\Http\Requests\ParserRequest;
use App\Models\Parser\Parser;
use App\Models\ParserOptions\ParserOptions;
use App\Models\Product\Product;
use App\Repository\ParserRepository;
use App\Repository\ProductRepository;

class ParserService
{
    /**
     * @var FileUpload
     */
    protected $imageUploader;
    /**
     * @var ParserRepository
     */
    protected $repository;
    /**
     * @var ParserDiDomService
     */
    private $parser;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(
        FileUpload $imageUploader,
        ParserRepository $repository,
        ProductRepository $productRepository,
        ParserDiDomService $parser
    )
    {
        $this->imageUploader     = $imageUploader;
        $this->repository        = $repository;
        $this->productRepository = $productRepository;
        $this->parser            = $parser;
    }

    public function save(ParserRequest $request, Parser $model)
    {
        try {
            $options = ParserOptions::query()->find($model->option_id);
            $option = $request->post('option');
            if($options) {
                $parserOptions = ParserOptions::query()->find($model->option_id);
                $parserOptions->update($option);
            } else {
                $parserOptions = ParserOptions::query()->firstOrCreate($option);
            }

            $model->setAttribute('option_id', $parserOptions->id);
            $model->fill($request->all());
            $parser = $model->query()->find([
                'url' => $request->post('url'),
            ]);

            if( !$parser || !$model->save() ) {
                throw new \Exception("Запись не сохранена!");
            }

            return $model;

        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }

    public function delete($id)
    {
        try {
            $parser = $this->repository->find($id);
            if(!$parser->delete()) {
                throw new \Exception("Произошла ошибка при удалении записи!");
            }
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }

    public function parseAndSave($id)
    {
        $parser = $this->repository->whereActive()->find($id);
        $this->parseAndCreate($parser);
    }

    public function parseAndSaveAll()
    {
        $parsers = $this->repository->whereActive()->get();
        foreach ($parsers as $parser)
        {
            $this->parseAndCreate($parser);
        }
    }

    private function parseAndCreate($parser)
    {
        $parsedProducts = $this->parser->parse($parser, $parser->url);
        foreach ($parsedProducts as $index => $row)
        {
            $attributes = $row;
            if( isset($row['img']) )
            {
                unset($attributes['img']);
            }

            $product = $this->productRepository->query()->firstOrNew([
                'name' => $attributes['name'],
                'category_id' => $attributes['category_id'],
                'store_id' => $attributes['store_id']
            ]);

            if(!$product->exists)
            {
                if( isset($row['img']) )
                {
                    $img = filter_var($row['img'], FILTER_VALIDATE_URL) ? $row['img'] : $product->store->info . $row['img'];
                    $image = $this->imageUploader->uploadByUrl($img, Product::TABLE_NAME);
                    $product->img = $image;
                }
            }

            $product->fill($attributes);
            $product->save();
        }
    }
}
