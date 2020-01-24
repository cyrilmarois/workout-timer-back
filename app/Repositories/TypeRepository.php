<?php

declare(strict_types=1);


namespace App\Repositories;

use App\Models\Type;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;

class TypeRepository extends BaseRepository
{
    public function model()
    {
        return Type::class;
    }

    public function applyParams(Request $request): BaseRepository
    {
        if (null !== $request->fields) {
            $explodeFields = explode(',', $request->fields);
            if (in_array('cycle', $explodeFields)) {
                $this->with(['cycle']);
            }
        }

        return $this;
    }
}
