<?php
/**
 * Created by PhpStorm.
 * User: yaroslav
 * Date: 11.07.19
 * Time: 15:16
 */

namespace App\Ship\Traits;


use Illuminate\Support\Collection;

trait DataForSelect
{
    /**
     * @param string $fields
     * @return Collection
     */
    public function getDataForSelect(array $fiels = ['*']) :Collection
    {
        return $this->model
            ->select($fiels)
            ->get();
    }
}
