<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Prettus\Repository\Eloquent\BaseRepository;

class SetRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Set';
    }

    public function applyParams(Request $request)
    {
        $fields = Arr::get($request->all(), 'fields') ?? [];
        if (filled($fields)) {
            $explodeFields = explode(',', $fields);
            if (in_array('timer', $explodeFields)) {
                $this->with(['timer']);
            }
        }

        return $this;
    }

}
