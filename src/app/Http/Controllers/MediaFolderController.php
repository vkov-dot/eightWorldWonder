<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaFolderRequest;
use App\Services\MediaFolderService;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class   MediaFolderController extends Controller
{
    private $service;

    public function __construct(MediaFolderService $service)
    {
        $this->service= $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return ApplicationAlias|Factory|ViewAlias
     */
    public function index()
    {
        return $this->service->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create()
    {
        $this->service->index();

        return response()->json(['message' => 'success']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MediaFolderRequest $request
     * @return JsonResponse
     */
    public function store(MediaFolderRequest $request): JsonResponse
    {
        $this->service->store($request);

        return response()->json(['message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->service->destroy($id);

        return response()->json(['message' => 'success']);
    }
}
