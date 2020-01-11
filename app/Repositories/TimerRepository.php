<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Prettus\Repository\Eloquent\BaseRepository;

class TimerRepository extends BaseRepository
{
    public function model()
    {
        return 'App\\Models\\Timer';
    }

    public function applyParams(Request $request)
    {
        if (null !== $request->fields) {
            $explodeFields = explode(',', $request->fields);
            if (in_array('set', $explodeFields)) {
                $this->with(['set']);
            }
        }

        return $this;
    }

    public function addSet(Request $request)
    {

    }
}
