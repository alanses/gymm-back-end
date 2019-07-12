<?php

namespace App\Modules\UserProfile\Tasks;

use App\Modules\UserProfile\Repositories\UserSettingRepository;
use App\Ship\Abstraction\AbstractTask;

class CreateOrUpdateProfileSettingTask extends AbstractTask
{
    /**
     * @var UserSettingRepository
     */
    private $settingRepository;

    public function __construct(UserSettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function run(array $attributes)
    {
        return $this->settingRepository->create($attributes);
    }
}
