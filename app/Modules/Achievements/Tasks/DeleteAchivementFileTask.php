<?php

namespace App\Modules\Achievements\Tasks;

use App\Modules\Achievements\Entities\Achievement;
use App\Modules\Admin\Services\FileService;
use App\Ship\Abstraction\AbstractTask;

class DeleteAchivementFileTask extends AbstractTask
{
    /**
     * @var FileService
     */
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function run(Achievement $achievement)
    {
        return $this->fileService->deleteFile($achievement->image);
    }
}
