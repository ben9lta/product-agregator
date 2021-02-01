<?php


namespace App\Services\Product;


use App\Contracts\FileUpload;
use App\Http\Requests\ProductRequest;
use App\Models\Product\Product;
use App\Repository\ProductRepository;

class ProductService
{
    /**
     * @var FileUpload
     */
    protected $imageUploader;
    /**
     * @var ProductRepository
     */
    protected $repository;

    public function __construct(FileUpload $imageUploader, ProductRepository $repository)
    {
        $this->imageUploader = $imageUploader;
        $this->repository    = $repository;
    }

    public function save(ProductRequest $request, Product $model)
    {
        try {
            $model->fill($request->all());

            if( $request->file('img') ) {
                $model->img = $this->imageUploader->upload($model::TABLE_NAME, $request->file('img') );
            }
            if(!$model->save()) {
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
            $product = $this->repository->find($id);
            if(!$product->delete()) {
                throw new \Exception("Произошла ошибка при удалении записи!");
            }
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }
}
