<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';

    protected $primaryKey = 'id';

    protected $fillable = [
        'slug'
    ];

    public function cycle()
    {
        return $this->hasMany(Cycle::class, 'type_id', 'id');
    }
}
