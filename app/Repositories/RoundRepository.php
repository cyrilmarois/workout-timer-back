<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Round;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;

class RoundRepository extends BaseRepository
{

    public function model()
    {
        return Round::class;
    }

    public function applyParams(Request $request)
    {
        if (null !== $request->fields) {
            $explodeFields = explode(',', $request->fields);
            if (filled($explodeFields)) {
                $this->with($explodeFields);
            }
        }

        return $this;
    }
}
