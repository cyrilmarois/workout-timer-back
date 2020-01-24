<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Cycle;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;

class CycleRepository extends BaseRepository
{

    public function model()
    {
        return Cycle::class;
    }

    public function applyParams(Request $request)
    {
        if (null !== $request->fields) {
            $withFields = [];
            $explodeFields = explode(',', $request->fields);
            if (in_array('sound', $explodeFields)) {
                $withFields[] = 'sound';
            }
            if (in_array('type', $explodeFields)) {
                $withFields[] = 'type';
            }
            if (filled($withFields)) {
                $this->with($withFields);
            }
        }

        return $this;
    }
}
