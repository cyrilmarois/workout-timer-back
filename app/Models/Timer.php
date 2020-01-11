<?php

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
        return $this->belongsToMany('App\Models\Set', 'timer_set', 'timer_id', 'set_id');
    }

}
