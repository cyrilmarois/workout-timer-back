<?php

declare(strict_types=1);


namespace App\Repositories;

use App\Models\Timer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TimerRepository extends XRepository
{
    public function model()
    {
        return parent::model();
    }

    public function addSet(Timer $timer, array $ids)
    {
        $now = now()->toDateTimeLocalString();
        $timer->set()->attach(
            $ids,
            [
                'created_at' => $now,
                'updated_at' => $now
            ]
        );

        return $timer;
    }

    public function removeSet(Timer $timer, array $ids)
    {
        $now = now()->toDateTimeLocalString();
        $timer->set()->detach(
            $ids,
            [
                'created_at' => $now,
                'updated_at' => $now
            ]
        );

        return $timer;
    }
}
