<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class XRepository extends BaseRepository
{
    public function model()
    {
        $class = explode('\\', get_called_class());
        $className = strstr($class[2], 'Repository', true);
        return 'App\\Models\\'.$className;


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
