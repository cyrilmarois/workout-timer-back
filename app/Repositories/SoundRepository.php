<?php

declare(strict_types=1);


namespace App\Repositories;

class SoundRepository extends XRepository
{

    public function model()
    {
        return parent::model();
    }

    function mapRelation()
    {
        return [
            'set' => 'cycle.round.set',
            'round' => 'cycle.round',
            'cycle' => 'cycle',
            'type' => 'cycle.type',
            'timer' => 'cycle.round.set.timer'
        ];
    }
}
