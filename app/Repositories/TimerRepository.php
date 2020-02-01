<?php

declare(strict_types=1);


namespace App\Repositories;

use App\Models\Timer;
use Illuminate\Http\Request;

class TimerRepository extends XRepository
{
    public function model()
    {
        return parent::model();
    }

    public function addSet(Timer $timer, Request $request)
    {
        $now = now()->toDateTimeLocalString();
        $timer->set()->attach(
            $request->ids,
            [
                'created_at' => $now,
                'updated_at' => $now
            ]
        );

        return $timer;
    }

    public function removeSet(Timer $timer, Request $request)
    {
        $now = now()->toDateTimeLocalString();
        $timer->set()->detach(
            $request->ids,
            [
                'created_at' => $now,
                'updated_at' => $now
            ]
        );

        return $timer;
    }
}
