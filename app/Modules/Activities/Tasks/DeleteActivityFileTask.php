<?php

namespace App\Modules\Activities\Tasks;

use App\Modules\Activities\Entities\Activity;
use App\Modules\Admin\Services\FileService;
use App\Ship\Abstraction\AbstractTask;

class DeleteActivityFileTask extends AbstractTask
{
    /**
     * @var FileService
     */
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function run(Activity $activity)
    {
        return $this->fileService->deleteFile($activity->image);
    }
}
