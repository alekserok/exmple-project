<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use LogsActivity, HasTranslations;

    public $translatable = ['title', 'content'];
    public static $translatable_attributes = ['title', 'content'];

    public $timestamps = false;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faqs';

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
    protected $fillable = ['category_id', 'title', 'content', 'translations'];

    public function setTranslationsAttribute($value)
    {
        foreach ($value as $key => $translations) $this->setTranslations($key, $translations);
    }

    public function category()
    {
        return $this->belongsTo('App\FaqCategory');
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
