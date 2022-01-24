<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\FileableInterface;
use App\Models\File;
use Illuminate\Http\UploadedFile;

final class FileService extends BaseService
{
    public function upload(UploadedFile $file, FileableInterface $fileable): File
    {
        try {
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $fileModel = new File();
            $fileModel->name = time().'_'.$file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->fileable()->associate($fileable);
            $fileModel->save();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }


        return  $fileModel;
    }
}
