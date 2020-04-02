<?php

namespace App\Repositories;

use Illuminate\Support\Arr;
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

    public function applyParams(array $params)
    {
        $fields = Arr::get($params, 'fields');
        if (!empty($fields)) {
            $explodeFields = explode(',', $fields);
            if (filled($explodeFields)) {
                $this->with($explodeFields);
            }
        }

        return $this;
    }
}
