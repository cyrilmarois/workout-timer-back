<?php

declare(strict_types=1);


namespace App\Http\Controllers;

use App\Http\Resources\Set as SetResource;
// use App\Http\Resources\SetCollection;
use App\Models\Set;
use App\Repositories\SetRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class SetController extends Controller
{

    /**
     * @var $repository SetRepository
     */
    protected $repository;

    /**
     * __construct
     *
     * @param  mixed $repository
     *
     * @return void
     */
    public function __construct(SetRepository $repository)
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
        $data = Set::create($request->input());

        return Response()->json(new SetResource($data), HttpResponse::HTTP_CREATED);
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

        return Response()->json(['data' => SetResource::collection($data)], HttpResponse::HTTP_OK);
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

        return Response()->json(new SetResource($data), HttpResponse::HTTP_OK);
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
        $data = $this->repository->find((int)$id)->fill($request->input());

        return Response()->json(new SetResource($data), HttpResponse::HTTP_OK);
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

        return Response()->json(new SetResource($data), HttpResponse::HTTP_OK);
    }
}
