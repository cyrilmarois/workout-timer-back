<?php

declare(strict_types=1);


namespace App\Repositories;


class TypeRepository extends XRepository
{
    public function model()
    {
        return parent::model();
    }

    function mapRelation(): array
    {
        return [
            'cycle' => 'cycle',
            'round' => 'cycle.round',
            'sound' => 'cycle.sound',
            'set' => 'cycle.round.set',
            'timer' => 'cycle.round.set.timer',
        ];
    }
}
