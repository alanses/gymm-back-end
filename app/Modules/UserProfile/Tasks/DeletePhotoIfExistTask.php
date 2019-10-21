<?php

namespace App\Modules\UserProfile\Tasks;

use App\Modules\Photos\Entities\UserPhoto;
use App\Modules\Photos\Repositories\UserPhotoRepository;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;
use Illuminate\Contracts\Filesystem\Factory as FilesystemManager;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class DeletePhotoIfExistTask extends AbstractTask
{
    /**
     * @var FilesystemManager
     */

    private $filesystemManager;
    /**
     * @var UserPhotoRepository
     */
    private $photoRepository;

    public function __construct(FilesystemManager $filesystemManager, UserPhotoRepository $photoRepository)
    {
        $this->filesystemManager = $filesystemManager;
        $this->photoRepository = $photoRepository;
    }

    public function run(User $user)
    {
        if($userPhoto = $user->userPhoto) {
            $this->deleteFromFileSystem(UserPhoto::getBasePathForUserPhotos(), $userPhoto->file_name);
            $this->deleteFromDatabase($user);
        }
    }

    private function deleteFromDatabase(User $user)
    {
        $this->photoRepository->deleteWhere([
            'user_id' => $user->id
        ]);
    }

    private function deleteFromFileSystem(string $path, ?string $fileName)
    {
        $path = $this->getPathToAvatar($path, $fileName);

        $this->filesystemManager->disk('public')->delete($path);
    }

    private function getPathToAvatar($path, $fileName)
    {
        return $path . DIRECTORY_SEPARATOR . $fileName;
    }
}
