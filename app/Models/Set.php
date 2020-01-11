<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $table ='set';

    protected $primaryKey = 'id';

    protected $fillable = [
        'round'
    ];

    public function timer()
    {
        return $this->belongsToMany('App\Models\Timer', 'timer_set', 'set_id', 'timer_id');
    }
}
