<?php

namespace App\Modules\GymClass\Tasks;

use App\Ship\Abstraction\AbstractTask;
use App\Ship\Interfaces\EntityInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Illuminate\Contracts\Filesystem\Factory as FilesystemManager;

class UploadImageTask extends AbstractTask
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

    public function run(UploadedFile $file, EntityInterface $model, ?int $userId, string $basePath)
    {
        $this->setPath($basePath);

        if (!$this->filesystem->exists($this->path)) {
            $this->filesystem->makeDirectory($this->path, $mode = 0777, true, true);
        }

        $random_string = md5(Str::random(8));

        $originalFilename = $file->getClientOriginalName();
        $originalFilename = explode('.', $originalFilename);
        $originalFilename = array_shift($originalFilename);

        $filename = "{$originalFilename}_{$userId}_{$random_string}.{$file->getClientOriginalExtension()}";

        $filename = $this->replaceAllSpacesIntoString($filename);

        $this->filesystemManager->disk('public')->put("{$this->path}/{$filename}", $file->get());

        $photo = $model->photos()->create(
            [
                'user_id' => $userId,
                'file_name' => "{$filename}",
                'origin_name' => $file->getClientOriginalName()
            ]
        );

        return $photo;
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
