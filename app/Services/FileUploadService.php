<?php


namespace App\Services;


use App\Contracts\FileUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService implements FileUpload
{
    public function upload(string $folder, UploadedFile $file)
    {
        return $file->store($folder, 'public');
    }

    public function uploadByUrl(string $url, string $folder)
    {
        $img = file_get_contents($url);
        $pathInfo = pathinfo(basename($url));
        $name = Str::random(40) . '.' . $pathInfo['extension'];
        $path = 'public/' . $folder . '/' . $name;
        Storage::put($path, $img);

        return $folder.'/'.$name;
    }

}
