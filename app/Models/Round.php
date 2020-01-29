<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $table = 'round';

    protected $primaryKey = 'id';

    protected $fillable = [
        'total',
    ];

    public function cycle()
    {
        return $this->belongsToMany(
            Cycle::class,
            'round_cycle',
            'round_id',
            'cycle_id'
        );
    }
}
