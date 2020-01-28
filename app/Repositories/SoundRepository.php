<?php

declare(strict_types=1);


namespace App\Repositories;

use App\Models\Sound;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;

class SoundRepository extends BaseRepository
{

    public function model()
    {
        return Sound::class;
    }

    public function applyParams(Request $request)
    {
        if (null !== $request->fields) {
            $explodeFields = explode(',', $request->fields);
            $this->with($explodeFields);
        }

        return $this;
    }
}
