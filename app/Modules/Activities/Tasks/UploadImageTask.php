<?php

namespace App\Modules\Activities\Tasks;

use App\Modules\Admin\Services\FileService;
use App\Ship\Abstraction\AbstractTask;
use Illuminate\Http\UploadedFile;

class UploadImageTask extends AbstractTask
{
    /**
     * @var FileService
     */
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function run(UploadedFile $file, string $basePath)
    {
        return $this->fileService->saveImageIntoFileSystem($file, $basePath);
    }
}
