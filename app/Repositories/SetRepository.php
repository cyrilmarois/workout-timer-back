<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Set;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;

class SetRepository extends BaseRepository
{
    public function model()
    {
        return Set::class;
    }

    public function applyParams(Request $request)
    {
        if (null !== $request->fields) {
            $explodeFields = explode(',', $request->fields);
            if (in_array('timer', $explodeFields)) {
                $this->with(['timer']);
            }
        }

        return $this;
    }

}
