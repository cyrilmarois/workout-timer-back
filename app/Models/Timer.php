<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    protected $table = 'timer';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
    ];

    public function set()
    {
        return $this->belongsToMany(
            Set::class,
            'timer_set',
            'timer_id',
            'set_id'
        );
    }

    public function user()
    {
        return $this->belongsToMany(
            User::class,
            'user_timer',
            'timer_id',
            'user_id'
        );
    }
}
