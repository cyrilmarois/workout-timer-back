<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';

    protected $primaryKey = 'id';

    protected $fillable = [
        'slug'
    ];

    public function round()
    {
        return $this->hasMany(Round::class, 'id', 'type_id');
    }
}
