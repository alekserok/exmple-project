<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use LogsActivity;

    const TYPE_INCALL = 1;
    const TYPE_OUTCALL = 2;

    const CARD = 9;

    public static $payment_methods = [
        1 => 'PAYPAL', 7 => 'CASH', 8 => 'WECHAT PAY', 9 => 'CARD', 2 => 'BITCOIN', 3 => 'LITECOIN',
        4 => 'DASH', 5 => 'ETHEREUM'
    ];

    public static $crypto_payment_methods = [
        2 => 'BITCOIN', 3 => 'LITECOIN', 4 => 'DASH', 5 => 'ETHEREUM'
    ];

    public static $types = [1 => 'INCALL', 2 => 'OUTCALL'];

    public static $time_slots = [
        '8:00-11:00' => '8:00-11:00',
        '11:00-16:00' => '11:00-16:00',
        '16:00-22:00' => '16:00-22:00',
        '22:00-2:00' => '22:00-2:00'
    ];

    public static $durations = [60 => 60, 90 => 90, 120 => 120];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
        'performer_id', 'payment_method', 'type', 'name', 'email', 'phone', 'duration',
        'date', 'time_slot', 'message', 'sessions', 'color_id',
    ];

    protected $appends = ['total'];

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    public function performer()
    {
        return $this->belongsTo('App\Performer');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function setDateAttribute($value)
    {
        if (is_numeric($value)) $this->attributes['date'] = date('Y-m-d', $value / 1000);
        else $this->attributes['date'] = $value;
    }

    public function getSessionsAttribute()
    {
        if (!isset($this->attributes['sessions']) || !$this->attributes['sessions']) return 1;
        return $this->attributes['sessions'];
    }

    public function getTotalAttribute()
    {
        $total = $this->performer->price * $this->duration / 60;
        if ($this->type == self::TYPE_INCALL) $total += setting('love_hotel_fee', 500);

        return $total * $this->sessions;
    }

    public function getPaidAttribute()
    {
        return $this->transactions()->where('status', Transaction::STATUS_COMPLETED)->first();
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
