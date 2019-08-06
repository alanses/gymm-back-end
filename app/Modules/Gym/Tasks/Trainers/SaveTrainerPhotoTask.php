<?php

namespace App\Modules\Gym\Tasks\Trainers;

use App\Modules\Gym\Entities\Trainer;
use App\Ship\Abstraction\AbstractTask;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as FilesystemManager;

class SaveTrainerPhotoTask extends AbstractTask
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

    public function run(Trainer $trainer, ?UploadedFile $photo)
    {
        if($photo) {

        }
    }
}
