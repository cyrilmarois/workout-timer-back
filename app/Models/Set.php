<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $table = 'set';

    protected $primaryKey = 'id';

    protected $fillable = [
        'repetition'
    ];

    public function timer()
    {
        return $this->belongsToMany(
            Timer::class,
            'timer_set',
            'set_id',
            'timer_id'
        );
    }
}
