<?php


namespace App\Modules\Admin\Services;

use App\Ship\Interfaces\ServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Illuminate\Contracts\Filesystem\Factory as FilesystemManager;

class FileService implements ServiceInterface
{
    private $filesystem;
    private $path;
    private $filesystemManager;

    /**
     * @param Filesystem $filesystem
     * @param FilesystemManager $filesystemManager
     */
    public function __construct(Filesystem $filesystem, FilesystemManager $filesystemManager)
    {
        $this->filesystem = $filesystem;
        $this->filesystemManager = $filesystemManager;
        $this->path = null;
    }

    public function saveImageIntoFileSystem(UploadedFile $file, string $basePath)
    {
        $this->setPath($basePath);

        if (!$this->filesystem->exists($this->path)) {
            $this->filesystem->makeDirectory($this->path, $mode = 0777, true, true);
        }

        $random_string = md5(Str::random(8));

        $originalFilename = $file->getClientOriginalName();
        $originalFilename = explode('.', $originalFilename);
        $originalFilename = array_shift($originalFilename);

        $filename = "{$originalFilename}_{$random_string}.{$file->getClientOriginalExtension()}";

        $filename = $this->replaceAllSpacesIntoString($filename);

        $path = "{$this->path}/{$filename}";

        $this->filesystemManager->disk('public')->put($path, $file->get());

        return $path;
    }

    public function deleteFile(?string $path)
    {
        if($path) {
            $this->filesystemManager->disk('public')->delete($path);
        }
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
