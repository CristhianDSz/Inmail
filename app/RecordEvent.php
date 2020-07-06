<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordEvent extends Model
{
    protected $table = 'record_events';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public static function register(User $user, Record $record, $action)
    {
        self::create([
            'user_id' => $user->id,
            'record' => $record->number,
            'record_type' => $record->type,
            'record_status' => $record->status ?? $action,
            'action' => $action
        ]);
    }
}
