<?php

namespace App\Modules\SliderImages\Tasks;

use App\Ship\Abstraction\AbstractTask;
use Illuminate\Contracts\Filesystem\Factory as FilesystemManager;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class SavePhotoIntoStorageTask extends AbstractTask
{
    private $filesystem;
    private $path;
    private $filesystemManager;

    /**
     * UploadImageTask constructor.
     * @param Filesystem $filesystem
     * @param FilesystemManager $filesystemManager
     */
    public function __construct(Filesystem $filesystem, FilesystemManager $filesystemManager)
    {
        $this->filesystem = $filesystem;
        $this->filesystemManager = $filesystemManager;
        $this->path = null;
    }

    public function run(UploadedFile $file, string $basePath)
    {
        $this->setPath($basePath);

        $random_string = md5(Str::random(8));

        $originalFilename = $file->getClientOriginalName();
        $originalFilename = explode('.', $originalFilename);
        $originalFilename = array_shift($originalFilename);

        $filename = "{$originalFilename}_{$random_string}.{$file->getClientOriginalExtension()}";

        $filename = $this->replaceAllSpacesIntoString($filename);

        $this->filesystemManager->disk('public')->put("{$this->path}/{$filename}", $file->get());

        return [
            'file_name' => "{$filename}",
            'origin_name' => $file->getClientOriginalName()
        ];
    }

    public function setPath(string $path)
    {
        $this->path = $path;

        return $this;
    }

    private function replaceAllSpacesIntoString($filename)
    {
        return str_replace(' ', '_', $filename);
    }
}
