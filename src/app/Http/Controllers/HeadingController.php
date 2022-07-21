<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeadingRequest;
use App\Services\HeadingService;
use http\Env\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class HeadingController extends Controller
{
    private $service;

    public function __construct(HeadingService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return $this->service->index();
    }

    public function getNames()
    {
        return $this->service->getNames();
    }

    /**
     * Store a newly created resource in storage
     *
     * @param HeadingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(HeadingRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->service->store($request);

        return response()->json(['message' => 'success']);
    }

    /**
     * Display the specified resource
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        return $this->service->show($id);
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        return $this->service->edit($id);
    }

    /**
     * Update the specified resource in storage
     *
     * @param HeadingRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(HeadingRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->service->update($request);

        return response()->json(['message' => 'success']);
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return response()->json(['message' => 'success']);
    }
}
