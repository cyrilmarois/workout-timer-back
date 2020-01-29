<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Cycle;
use App\Models\Sound;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Prettus\Repository\Eloquent\BaseRepository;

class CycleRepository extends BaseRepository
{

    public function model()
    {
        return Cycle::class;
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

    public function store(Request $request)
    {
        $input = $request->input();
        $typeId = Arr::get('type_id', $input);
        if (null !== $typeId) {
            Type::findOrFail($typeId);
        }

        $soundId = Arr::get('sound_id', $input);
        if (null !== $soundId) {
            Sound::findOrFail($soundId);
        }
        $data = Cycle::create($input);
        if (Arr::get('type_id', $input)) {
            $this->addType($data, $input);
        }

        if (Arr::get('sound_id', $input)) {
            $this->addSound($data, $input);
        }

        return $this->applyParams($request)->find($data->id);
    }

    public function update(array $input, $id)
    {
        $typeId = Arr::get('type_id', $input);
        if (null !== $typeId) {
            Type::findOrFail($typeId);
        }

        $soundId = Arr::get('sound_id', $input);
        if (null !== $soundId) {
            Sound::findOrFail($soundId);
        }
        $data = $this->find((int)$id)->fill($input);
        $data->save();
        if (Arr::get('type_id', $input)) {
            $this->addType($data, $input);
        }

        if (Arr::get('sound_id', $input)) {
            $this->addSound($data, $input);
        }

        return $this->with(['type', 'sound'])->find($data->id);
    }

    private function addType(Cycle $cycle, array $input)
    {
        $now = now()->toDateTimeLocalString();
        $cycle->type()->attach(
            Arr::get($input, 'type_id'),
            [
                'created_at' => $now,
                'updated_at' => $now
            ]
        );

        return $cycle;
    }

    private function addSound(Cycle $cycle, array $input)
    {
        $now = now()->toDateTimeLocalString();
        $cycle->sound()->attach(
            Arr::get($input, 'sound_id'),
            [
                'created_at' => $now,
                'updated_at' => $now
            ]
        );

        return $cycle;
    }
}
