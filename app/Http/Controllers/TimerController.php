<?php

declare(strict_types=1);


namespace App\Http\Controllers;

use App\Http\Resources\Timer as TimerResource;
// use App\Http\Resources\TimerCollection;
use App\Models\Timer;
use App\Repositories\TimerRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class TimerController extends Controller
{

    /**
     * @var $repository TimerRepository
     */
    protected $repository;

    /**
     * __construct
     *
     * @param  mixed $repository
     *
     * @return void
     */
    public function __construct(TimerRepository $repository)
    {
        $this->repository = $repository;
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
        $data = Timer::create($request->input());

        return Response()->json(new TimerResource($data), HttpResponse::HTTP_CREATED);
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
        $data = $this->repository->applyParams($request)->paginate();

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
        $data = $this->repository->applyParams($request)->find($id);

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
        $data = $this->repository->addSet($timer, $request);
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
        $data = $this->repository->removeSet($timer, $request);
        $data = $data->with(['set'])->find($id);

        return Response()->json(new TimerResource($data), HttpResponse::HTTP_OK);
    }
}
