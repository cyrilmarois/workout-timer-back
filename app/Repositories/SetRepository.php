<?php

declare(strict_types=1);

namespace App\Repositories;

class SetRepository extends XRepository
{
    public function model()
    {
        return parent::model();
    }

    public function create(array $attributes)
    {
        return $this->model()::create($attributes);
    }

}
