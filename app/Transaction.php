<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Transaction extends Model
{
    use LogsActivity;

    const STATUS_NEW = 0;
    const STATUS_PENDING = 1;
    const STATUS_ERROR = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_CANCELLED = 4;

    public static $statuses = [0 => 'NEW', 1 => 'PENDING', 2 => 'ERROR', 3 => 'COMPLETED', 4 => 'CANCELLED'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

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
    protected $fillable = ['order_id', 'gateway', 'reference', 'currency', 'amount', 'data', 'status'];

    protected $casts = ['data' => 'json'];

    public function order()
    {
        return $this->belongsTo('App\Order');
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
