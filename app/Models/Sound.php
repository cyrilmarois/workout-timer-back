<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sound extends Model
{
    protected $table = 'sound';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'filename',
    ];

    protected $guarded = [];

    public function round()
    {
        return $this->hasMany(Round::class, 'sound_id', 'id');
    }
}
