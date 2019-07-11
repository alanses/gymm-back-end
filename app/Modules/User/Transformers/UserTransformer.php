<?php

namespace App\Modules\User\Transformers;

use App\Ship\Abstraction\AbstractEntity;
use App\Ship\Interfaces\EntityInterface;
use App\Ship\Parents\Transformer;
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
    public function transform(AbstractEntity $entity)
    {
        $response = [
            'user_id' => $entity->id,
            'email' => $entity->email,
            'name' => $entity->name,
            'response-content' => $entity->response_content,
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at
        ];

        return $response;
    }
}
