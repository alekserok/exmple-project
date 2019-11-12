<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Promo extends Model
{
    use LogsActivity, HasTranslations;

    const TYPE_IMAGE = 0;
    const TYPE_VIDEO = 1;

    protected $table = 'promos';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'media', 'link', 'link_title', 'location_page', 'type', 'translations'];

    public $timestamps = false;

    public static $types = [0 => 'Image', 1 => 'Video'];

    public $translatable = ['title', 'link_title'];
    public static $translatable_attributes = ['title', 'link_title'];

    public function setTranslationsAttribute($value)
    {
        foreach ($value as $key => $translations) $this->setTranslations($key, $translations);
    }

    public function scopeIsAvailable($query, $location)
    {
        return $query->where([
            ['location_page', $location]
        ]);
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
