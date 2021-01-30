<?php


namespace App\Contracts;


use Illuminate\Http\UploadedFile;

interface FileUpload
{
    public function upload(string $folder, UploadedFile $file);
}
