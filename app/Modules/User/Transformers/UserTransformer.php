<?php

namespace App\Modules\User\Transformers;

use App\Modules\Category\Transformers\CategoryTransformer;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractEntity;
use App\Ship\Interfaces\EntityInterface;
use App\Ship\Parents\Transformer;
use App\Ship\Parents\Entity;
use League\Fractal\Resource\Collection;
use ReflectionException;

class UserTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [
    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [
    ];

    /**
     * A Fractal transformer.
     *
     * @param EntityInterface $entity
     * @return array
     * @throws ReflectionException
     */
    public function transform(EntityInterface $entity)
    {
        $response = [
            'id' => $entity->id,
            'email' => $entity->email,
            'response-content' => $entity->response_content,
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at
        ];

        return $response;
    }
}
