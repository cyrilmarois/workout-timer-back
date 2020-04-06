<?php

declare(strict_types=1);

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Type;
use App\Models\Cycle;
use App\Models\Round;
use App\Models\Sound;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class CycleRepository extends XRepository
{
    public function model()
    {
        return parent::model();
    }


    public function store(array $attributes, Round $round)
    {

        $cycles = Arr::get($attributes, 'cycles');
        if (!empty($cycles)) {
            $cycles = is_array($cycles) ? $cycles : [$cycles];
            $attributes = [];
            foreach($cycles as $i => $cycle) {
                $cycle = $this->create($cycle);
                $now = now()->toDateTimeLocalString();
                if ($cycle instanceof Cycle) {
                    $attributes[$cycle->id] = [
                        'round_id' => $round->id,
                        'order' => $i+1,
                        'created_at' => $now,
                        'updated_at' => $now

                    ];
                }
            }
            $this->addRound($cycle, $attributes);
        };
    }

    public function create(array $attributes): Cycle
    {
        $type = null;
        $sound = null;
        $typeId = Arr::get($attributes, 'type');
        if (null !== $typeId) {
            $type = Type::findOrFail($typeId);
        }

        $soundId = Arr::get($attributes, 'sound');
        if (null !== $soundId) {
            $sound = Sound::findOrFail($soundId);
        }
        $hour = Arr::get($attributes, 'hour') ?? '00';
        $minute = Arr::get($attributes, 'minute') ?? '00';
        $second = Arr::get($attributes, 'second') ?? '00';
        $time = Carbon::createFromTimeString("{$hour}:{$minute}:{$second}")
            ->format('H:i:s');
        $data = $this->model()::create([
            'duration' => $time,
            'sound_id' => $sound->id,
            'type_id' => $type->id,
        ]);

        return $this->applyParams($attributes)->find($data->id);
    }

    public function update(array $input, $id)
    {
        $typeId = Arr::get($input, 'type_id');
        if (null !== $typeId) {
            Type::findOrFail($typeId);
        }

        $soundId = Arr::get($input, 'sound_id');
        if (null !== $soundId) {
            Sound::findOrFail($soundId);
        }
        $data = $this->find((int)$id)->fill($input);
        $data->save();

        return $this->with(['type', 'sound'])->find($data->id);
    }

    public function addRound(Cycle $cycle, array $attributes): Cycle
    {
        $now = now()->toDateTimeLocalString();
        $cycle->round()->attach($attributes);

        return $cycle;
    }

    public function removeRound(Cycle $cycle, array $attributes): Cycle
    {
        $now = now()->toDateTimeLocalString();
        $cycle->round()->detach($attributes);

        return $cycle;
    }

    function mapRelation()
    {
        return [
            'timer' => 'round.set.timer',
            'set' => 'round.set',
            'round' => 'round',
            'sound' => 'sound',
            'type' => 'type',
        ];
    }
}
