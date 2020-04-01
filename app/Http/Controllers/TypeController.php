<?php

declare(strict_types=1);


namespace App\Http\Controllers;

use App\Http\Resources\Type as TypeResource;
use App\Models\Type;
use App\Repositories\TypeRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class TypeController extends Controller
{

    /**
     * @var $repository TypeRepository
     */
    protected $repository;

    /**
     * __construct
     *
     * @param  mixed $repository
     *
     * @return void
     */
    public function __construct(TypeRepository $repository)
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
        // Not implemented
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

        return Response()->json(['data' => TypeResource::collection($data)], HttpResponse::HTTP_OK);
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

        return Response()->json(new TypeResource($data), HttpResponse::HTTP_OK);
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
