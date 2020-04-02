<?php

declare(strict_types=1);


namespace App\Repositories;

use App\Models\Timer;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimerRepository extends XRepository
{
    public function model()
    {
        return parent::model();
    }

    public function create(array $attributes)
    {
        $timer = $this->model()::create($attributes);
        if (false !== $timer) {
            $this->addUser($timer, [Auth::user()->id]);
        }
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

    public function addUser(Timer $timer, array $ids)
    {
        $now = now()->toDateTimeLocalString();
        $timer->user()->attach(
            $ids,
            [
                'created_at' => $now,
                'updated_at' => $now
            ]
        );

        return $timer;
    }

    public function removeUser(Timer $timer, array $ids)
    {
        $now = now()->toDateTimeLocalString();
        $timer->user()->detach(
            $ids,
            [
                'created_at' => $now,
                'updated_at' => $now
            ]
        );

        return $timer;
    }
}
