<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Career extends Model
{
    use LogsActivity;

    const TYPE_AVSTAR = 1;
    const TYPE_ESCORT = 2;
    const TYPE_CAMERA_OPERATOR = 3;
    const TYPE_RECEPTIONIST = 4;
    const TYPE_PRODUCTION_ASSISTANT = 5;
    const TYPE_ILLUSTRATOR_ANIMATOR = 6;

    public static $performer_types = ['A/V STAR' => 1, 'ESCORT' => 2];
    public static $staff_types = [
       'CAMERA OPERATOR' => 3, 'RECEPTIONIST' => 4, 'PRODUCTION ASSISTANT' => 5, 'ILLUSTRATOR / ANIMATOR' => 6,
    ];
    public static $types = [
        1 => 'A/V STAR', 2 => 'ESCORT', 3 => 'CAMERA OPERATOR', 4 => 'RECEPTIONIST',
        5 => 'PRODUCTION ASSISTANT', 6 => 'ILLUSTRATOR / ANIMATOR'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'careers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'name', 'age', 'visa_status', 'nationality', 'language', 'contacts', 'socials', 'attachment'];



    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }
}
