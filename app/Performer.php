<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Performer extends Model
{
    use LogsActivity, HasTranslations;

    public $translatable = ['eyes', 'hair', 'body_details', 'availability'];
    public static $translatable_attributes = ['eyes', 'hair', 'body_details', 'availability'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'performers';

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
    protected $fillable = [
        'letter', 'name', 'eyes', 'hair', 'country', 'body_details', 'availability', 'translations', 'price'
    ];

    public function setTranslationsAttribute($value)
    {
        foreach ($value as $key => $translations) $this->setTranslations($key, $translations);
    }

    public function getAvatarAttribute()
    {
        return $this->images->count() ? $this->images[0]->src : 'default-image.jpg';
    }

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Color');
    }
    public function images()
    {
        return $this->hasMany('App\Image');
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
