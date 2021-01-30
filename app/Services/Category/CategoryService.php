<?php


namespace App\Services\Category;


use App\Contracts\FileUpload;
use App\Http\Requests\CategoryRequest;
use App\Models\Category\Category;
use App\Repository\CategoryRepository;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    /**
     * @var FileUpload
     */
    protected $imageUploader;
    /**
     * @var CategoryRepository
     */
    protected $repository;

    public function __construct(FileUpload $imageUploader, CategoryRepository $repository)
    {
        $this->imageUploader = $imageUploader;
        $this->repository    = $repository;
    }

    public function save(CategoryRequest $request, Category $model)
    {
        try {
            $model->fill($request->all());

            if( $request->file('img') ) {
                $model->img = $this->imageUploader->upload($model::TABLE_NAME, $request->file('img') );
            }
            if( $request->file('icon') ) {
                $model->icon = $this->imageUploader->upload($model::TABLE_NAME, $request->file('icon') );
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
            $category = $this->repository->find($id);
            if(!$category->delete()) {
                throw new \Exception("Произошла ошибка при удалении записи!");
            }
        } catch (\Throwable $e) {
            throw new \Exception($e);
        }

    }
}
