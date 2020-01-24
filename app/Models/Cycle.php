<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    protected $table = 'cycle';

    protected $primaryKey = 'id';

    protected $fillable = [
        'duration',
        'type_id',
        'sound_id'
    ];

    public function type()
    {
        return $this->hasOne(Type::class, 'id', 'type_id');
    }

    public function sound()
    {
        return $this->hasOne(Sound::class, 'id', 'sound_id');
    }

    public function round()
    {
        return $this->belongsToMany(
            Round::class,
            'round_cycle',
            'cycle_id',
            'round_id'
        );
    }
}
