<?php

declare(strict_types=1);


namespace App\Http\Controllers;

use App\Http\Resources\Timer as TimerResource;
use App\Models\Set;
use App\Models\Timer;
use App\Repositories\CycleRepository;
use App\Repositories\RoundRepository;
use App\Repositories\SetRepository;
use App\Repositories\SoundRepository;
use App\Repositories\TimerRepository;
use App\Repositories\TypeRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class TimerController extends Controller
{

    /**
     * @var $repository TimerRepository
     */
    protected $repository;

    /**
     * @var $cycleRepository CycleRepository
     */
    protected $cycleRepository;

    /**
     * @var $roundRepository RoundRepository
     */
    protected $roundRepository;

    /**
     * @var $setRepository SetRepository
     */
    protected $setRepository;

    /**
     * @var $soundRepository SoundRepository
     */
    protected $soundRepository;

    /**
     * @var $typeRepository TypeRepository
     */
    protected $typeRepository;

    /**
     * __construct
     *
     * @param  mixed $repository
     * @param  mixed $cycleRepository
     * @param  mixed $roundRepository
     * @param  mixed $setRepository
     * @param  mixed $soundRepository
     * @param  mixed $typeRepository
     *
     * @return void
     */
    public function __construct(TimerRepository $repository,
                                CycleRepository $cycleRepository,
                                RoundRepository $roundRepository,
                                SetRepository $setRepository,
                                SoundRepository $soundRepository,
                                TypeRepository $typeRepository)
    {
        $this->repository = $repository;
        $this->cycleRepository = $cycleRepository;
        $this->roundRepository = $roundRepository;
        $this->setRepository = $setRepository;
        $this->soundRepository = $soundRepository;
        $this->typeRepository = $typeRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory;
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = null;
        DB::beginTransaction();
        $timer = $this->repository->create($request->all());
        if ($timer instanceof Timer) {
            $set = $this->setRepository->create($request->all());
            if ($set instanceof Set) {
                $this->repository->addSet($timer, [$set->id]);
                $cycle = $this->cycleRepository->store($request);
            }

            DB::commit();
            $data = $this->repository->find($timer->id)->with([
                'cycle',
                'round',
                'set',
                'sound',
                'type'
            ]);
            $data = new TimerResource($data);
        }

        return Response()->json($data, HttpResponse::HTTP_CREATED);
    }


    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory;
     */
    public function index(Request $request)
    {
        $data = $this->repository->applyParams($request->all())->paginate();

        return Response()->json(['data' => TimerResource::collection($data)], HttpResponse::HTTP_OK);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory;
     */
    public function show($id, Request $request)
    {
        $data = $this->repository->applyParams($request->all())->find($id);

        return Response()->json(new TimerResource($data), HttpResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory;
     */
    public function update($id, Request $request)
    {
        $data = $this->repository->find((int)$id)->fill($request->input());

        return Response()->json(new TimerResource($data), HttpResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory;
     */
    public function destroy($id)
    {
        $data = $this->repository->find($id);
        $data->delete();

        return Response()->json(new TimerResource($data), HttpResponse::HTTP_OK);
    }

    /**
     * Attach Set to Timer.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory;
     */
    public function addSet($id, Request $request)
    {
        $timer = $this->repository->find($id);
        $data = $this->repository->addSet($timer, $request->all());
        $data = $data->with(['set'])->find($id);

        return Response()->json(new TimerResource($data), HttpResponse::HTTP_OK);
    }

    /**
     * Remove Set to Timer.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory;
     */
    public function RemoveSet($id, Request $request)
    {
        $timer = $this->repository->find($id);
        $data = $this->repository->removeSet($timer, $request->all());
        $data = $data->with(['set'])->find($id);

        return Response()->json(new TimerResource($data), HttpResponse::HTTP_OK);
    }
}
