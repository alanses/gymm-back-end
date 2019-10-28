<?php


namespace App\Ship\Abstraction;

use App\Ship\Interfaces\ParentInterface;
use App\Ship\Interfaces\TaskInterface;
use App\Ship\Traits\CallableTrait;
use App\Ship\Traits\HttpResponses;

abstract class AbstractTask implements TaskInterface, ParentInterface
{
    use CallableTrait;
    use HttpResponses;

    protected $selectedFields = ['*'];

    /**
     * @return array
     */
    public function getSelectedFields(): array
    {
        return $this->selectedFields;
    }

    /**
     * @param array $selectedFields
     */
    public function setSelectedFields(array $selectedFields): void
    {
        $this->selectedFields = $selectedFields;
    }
}
