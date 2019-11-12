<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use LogsActivity, HasTranslations;

    const CATEGORY_MEN = 1;
    const CATEGORY_WOMEN = 2;
    const CATEGORY_SEXBOT = 3;

    public $translatable = ['name'];
    public static $translatable_attributes = ['name'];

    public static $root_categories = ['men' => 1, 'women' => 2, 'sexbot' => 3];

    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
    protected $fillable = ['name', 'translations'];

    public function setTranslationsAttribute($value)
    {
        foreach ($value as $key => $translations) $this->setTranslations($key, $translations);
    }

    public function parents()
    {
        return $this->belongsToMany('App\Category', 'category_parent', 'parent_id', 'category_id');
    }

    public function children()
    {
        return $this->belongsToMany('App\Category', 'category_parent', 'category_id', 'parent_id');
    }

    public function scopeParentCategories($query)
    {
        return $query->doesntHave('parents');
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
