<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Color extends Model
{
    use LogsActivity, HasTranslations;

    public $timestamps = false;

    protected $fillable = ['name', 'color', 'translations'];

    public $translatable = ['name'];
    public static $translatable_attributes = ['name'];

    public function setTranslationsAttribute($value)
    {
        foreach ($value as $key => $translations) $this->setTranslations($key, $translations);
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function performers()
    {
        return $this->belongsToMany('App\Performer');
    }
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
