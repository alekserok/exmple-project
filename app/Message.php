<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['chat_id', 'user_id', 'text'];

    public function scopeLatestChat($query)
    {
        $query->groupBy('chat_id')
            ->selectRaw('chat_id, group_concat(text order by id desc limit 1) as text, max(created_at) as created_at')
            ->orderBy('created_at', 'desc');
    }
}
