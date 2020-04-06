<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Cycle;
use App\Models\Round;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoundRepository extends XRepository
{

    public function model()
    {
        return parent::model();
    }

    public function store(Request $request)
    {
        $input = $request->input();
        $total = Arr::get($input, 'total');
        $round = $this->model->create(['total' => $total]);
        if ($round instanceof $this->model) {
            $cycleId = Arr::get($input, 'cycle_id');
            if (filled($cycleId)) {
                foreach($cycleId as $i => $tmpCycleId) {
                    $cycle = Cycle::findOrFail($tmpCycleId);
                    $this->addCycle($round, $cycle, $i);
                }
            }
        }

        return $this->with(['cycle.sound', 'cycle.type'])->find($round->id);
    }

    private function addCycle(Round $round, Cycle $cycle, int $orderId)
    {
        $now = now()->toDateTimeLocalString();
        $round->cycle()->attach(
            $cycle->id,
            [
                'order' => $orderId,
                'created_at' => $now,
                'updated_at' => $now
            ]
        );
    }

    function mapRelation()
    {
        return [
            'timer' => 'set.timer',
            'set' => 'round.set',
            'cycle' => 'cycle',
            'sound' => 'cycle.sound',
            'type' => 'cycle.type',
        ];
    }

}
