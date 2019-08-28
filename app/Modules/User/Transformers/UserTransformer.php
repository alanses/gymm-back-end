<?php

namespace App\Modules\User\Transformers;

use App\Modules\User\Entities\User;
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
            'user_type' => $this->getUserType($entity),
            'email' => $entity->email,
            'name' => $entity->name,
            'content' => $entity->response_content,
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at
        ];

        return $response;
    }

    private function getUserType(AbstractEntity $entity)
    {
        if($entity->user_type == User::$is_user) {
            return 'user';
        }

        if($entity->user_type == User::$is_gym) {
            return 'gym';
        }

        if($entity->user_type == User::$is_admin) {
            return 'supper_admin';
        }
    }
}
