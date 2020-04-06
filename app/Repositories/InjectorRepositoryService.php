<?php

namespace App\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class InjectorRepositoryService
{
    /**
     * @var array
     */
    private $repository = [];

    /**
     * @param CycleRepository $cycleRepository
     * @param RoundRepository $roundRepository
     * @param SetRepository $setRepository
     * @param SoundRepository $soundRepository
     * @param TimerRepository $timerRepository
     * @param TypeRepository $typeRepository
     */
    public function __construct(CycleRepository $cycleRepository,
                                RoundRepository $roundRepository,
                                SetRepository $setRepository,
                                SoundRepository $soundRepository,
                                TimerRepository $timerRepository,
                                TypeRepository $typeRepository)
    {

        $this->setRepository([
            $cycleRepository,
            $roundRepository,
            $setRepository,
            $soundRepository,
            $timerRepository,
            $typeRepository,
        ]);
    }

    /**
     * @param array $repositories
     * @return void
     */
    public function setRepository(array $repositories): void
    {
        foreach($repositories as $repository) {
            $this->repository[$this->transformKey($repository)] = $repository;
        }
    }

    /**
     * @param [type] $repository
     * @return string
     */
    private function transformKey($repository): string
    {
        $class = explode('\\', get_class($repository));
        $key = strtolower(strstr($class[2], 'Repository', true));

        return $key;
    }

    /**
     * @param string|null $repository
     * @return void
     */
    public function getRepository(?string $repository = null)
    {
        if ($repository && Arr::get($this->repository, $repository)) {
            return Arr::get($this->repository, $repository);
        }

        return $this->repository;
    }
}
