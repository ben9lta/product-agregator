<?php


namespace App\Services;


use App\Contracts\FileUpload;
use Illuminate\Http\UploadedFile;

class FileUploadService implements FileUpload
{
    public function upload(string $folder, UploadedFile $file)
    {
        return $file->store($folder, 'public');
    }

}
