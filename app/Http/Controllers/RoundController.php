<?php

declare(strict_types=1);


namespace App\Http\Controllers;

use App\Http\Resources\Round as RoundResource;
use App\Models\Round;
use App\Repositories\RoundRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class RoundController extends Controller
{

    /**
     * @var $repository RoundRepository
     */
    protected $repository;

    /**
     * __construct
     *
     * @param  mixed $repository
     *
     * @return void
     */
    public function __construct(RoundRepository $repository)
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
        $data = $this->repository->store($request);

        return Response()->json(new RoundResource($data), HttpResponse::HTTP_CREATED);
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

        return Response()->json(['data' => RoundResource::collection($data)], HttpResponse::HTTP_OK);
    }


    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory;
     */
    public function show(Request $request, $id)
    {
        $data = $this->repository->applyParams($request->all())->find($id);

        return Response()->json(new RoundResource($data), HttpResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory;
     */
    public function update(Request $request, $id)
    {
        dd($request->input());
        $data = $this->repository->find((int)$id)->fill($request->input());
        $data = $data->with(['type', 'round'])->find($data->id);

        return Response()->json(new RoundResource($data), HttpResponse::HTTP_OK);
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

        return Response()->json(new RoundResource($data), HttpResponse::HTTP_OK);
    }

    /**
     * Attach Round to Timer.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory;
     */
    public function addCycle($id, Request $request)
    {
        $timer = $this->repository->find($id);
        $data = $this->repository->addCycle($timer, $request);
        $data = $data->with(['cycle'])->find($id);

        return Response()->json(new RoundResource($data), HttpResponse::HTTP_OK);
    }

    /**
     * Remove Round to Timer.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory;
     */
    public function RemoveCycle($id, Request $request)
    {
        $timer = $this->repository->find($id);
        $data = $this->repository->removeCycle($timer, $request);
        $data = $data->with(['cycle'])->find($id);

        return Response()->json(new RoundResource($data), HttpResponse::HTTP_OK);
    }
}
