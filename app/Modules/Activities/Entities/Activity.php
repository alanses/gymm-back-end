<?php

namespace App\Modules\Activities\Entities;

use App\Modules\Achievements\Entities\Achievement;
use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractEntity;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Activity extends AbstractEntity
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'displayed_name',
        'image'
    ];

    public $translatable = ['displayed_name'];

    public static $PATH_FOR_IMAGE = 'Admin/Activity';

    /**
     * @return BelongsToMany
     */
    public function users() :BelongsToMany
    {
        return $this->belongsToMany(User::class, 'activities_users', 'activity_id', 'user_id');
    }

    public function achievement()
    {
        return $this->hasOne(Achievement::class, 'achivement_id', 'id');
    }

    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class, 'activities_id', 'id');
    }
}
