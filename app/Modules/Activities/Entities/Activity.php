<?php

namespace App\Modules\Activities\Entities;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractEntity;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Activity extends AbstractEntity
{
    protected $fillable = [
        'name',
        'displayed_name',
    ];

    /**
     * @return BelongsToMany
     */
    public function users() :BelongsToMany
    {
        return $this->belongsToMany(User::class, 'activities_users', 'activity_id', 'user_id');
    }
}
