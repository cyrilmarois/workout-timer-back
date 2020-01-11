<?php

namespace App\Repositories;

use App\Models\Timer;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;

class TimerRepository extends BaseRepository
{
    public function model()
    {
        return 'App\\Models\\Timer';
    }

    public function applyParams(Request $request): BaseRepository
    {
        if (null !== $request->fields) {
            $explodeFields = explode(',', $request->fields);
            if (in_array('set', $explodeFields)) {
                $this->with(['set']);
            }
        }

        return $this;
    }

    public function addSet(Timer $timer, Request $request)
    {
        $now = now()->toDateTimeLocalString();
        $timer->set()->attach($request->ids,[
            'created_at' => $now,
            'updated_at' => $now
        ]);

        return $timer;
    }

    public function removeSet(Timer $timer, Request $request)
    {
        $now = now()->toDateTimeLocalString();
        $timer->set()->detach($request->ids,[
            'created_at' => $now,
            'updated_at' => $now
        ]);

        return $timer;
    }
}
