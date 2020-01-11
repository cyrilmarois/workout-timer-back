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
        $fields = Arr::get($request->all(), 'fields') ?? [];
        if (filled($fields)) {
            $explodeFields = explode(',', $fields);
            if (in_array('set', $explodeFields)) {
                $this->with(['set']);
            }
        }

        return $this;
    }
}
