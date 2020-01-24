<?php

declare(strict_types=1);

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

    public function cycle()
    {
        return $this->hasMany(Cycle::class, 'sound_id', 'id');
    }
}
