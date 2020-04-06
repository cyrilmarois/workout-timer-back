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
            $withRelation = $this->overrideRelation($fields);
            if (filled($withRelation)) {
                $this->with($withRelation);
            }
        }

        return $this;
    }

    abstract function mapRelation();

    private function overrideRelation($fields): array
    {
        $wihRelation = [];
        $explodeFields = explode(',', $fields);
        $relations = (array)$this->mapRelation();
        foreach ($relations as $key => $relation) {
            foreach ($explodeFields as $explodeField) {
                if ($key === $explodeField) {
                    $wihRelation[] = $relation;
                    break;
                }
            }
        }

        return $wihRelation;
    }
}
