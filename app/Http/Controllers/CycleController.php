<?php

declare(strict_types=1);


namespace App\Http\Controllers;

use App\Http\Resources\Cycle as CycleResource;
// use App\Http\Resources\CycleCollection;
use App\Models\Cycle;
use App\Repositories\CycleRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class CycleController extends Controller
{

    /**
     * @var $repository CycleRepository
     */
    protected $repository;

    /**
     * __construct
     *
     * @param  mixed $repository
     *
     * @return void
     */
    public function __construct(CycleRepository $repository)
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
        $data = Cycle::create($request->input());
        $data = $data->with(['type', 'round'])->find($data->id);

        return Response()->json(new CycleResource($data), HttpResponse::HTTP_CREATED);
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

        // return Response()->json(CycleCollection::make($data), HttpResponse::HTTP_OK);
        return Response()->json(CycleResource::collection($data), HttpResponse::HTTP_OK);
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
        $request = new Request();
        $request->input(['fields' => 'type,round']);
        $data = $this->repository->applyParams($request)->find($id);

        return Response()->json(new CycleResource($data), HttpResponse::HTTP_OK);
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
        $request = new Request();
        $request->input(['fields' => 'type,round']);
        $data = $this->repository->applyParams($request)->find($data->id);

        return Response()->json(new CycleResource($data), HttpResponse::HTTP_OK);
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

        return Response()->json(new CycleResource($data), HttpResponse::HTTP_OK);
    }
}
