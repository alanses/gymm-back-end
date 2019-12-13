<?php

namespace App\Modules\Achievements\Entities;

use App\Modules\Activities\Entities\Activity;
use App\Ship\Abstraction\AbstractEntity;
use Spatie\Translatable\HasTranslations;

class Achievement extends AbstractEntity
{
    use HasTranslations;

    public $translatable = ['displayed_name'];

    protected $table = 'achivements';

    protected $fillable = [
        'displayed_name',
        'count_classes',
        'activity_id',
        'image'
    ];

    public static $PATH_FOR_IMAGE = 'Admin/Achivements';

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'id');
    }

}
