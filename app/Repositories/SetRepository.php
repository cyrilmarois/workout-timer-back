<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Round;
use App\Models\Set;
use Illuminate\Database\Eloquent\Model;

class SetRepository extends XRepository
{
    public function model()
    {
        return parent::model();
    }

    public function create(array $attributes): Model
    {
        $set = $this->model()::create($attributes);
        if ($set instanceof Model) {
            // create default round
            $round = new Round(['total' => 1]);
            $round->save();
            $this->addRound($set, [$round->id]);
        }

        return $set;
    }

    public function addRound(Set $set, $ids)
    {
        $now = now()->toDateTimeLocalString();
        $set->round()->attach(
            $ids,
            [
                'created_at' => $now,
                'updated_at' => $now
            ]
        );

        return $set;
    }

    public function removeRound(Set $set, array $ids)
    {
        $now = now()->toDateTimeLocalString();
        $set->round()->detach(
            $ids,
            [
                'created_at' => $now,
                'updated_at' => $now
            ]
        );

        return $set;
    }
}
