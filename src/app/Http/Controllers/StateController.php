<?php

namespace App\Http\Controllers;

use App\Http\Requests\StateEditRequest;
use App\Http\Requests\StateRequest;
use App\Repositories\HeadingRepository;
use App\Services\HeadingService;
use App\Services\StateService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StateController extends Controller
{
    private $service;

    public function __construct(StateService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource
     *
     * @return Application
     */
    public function index()
    {
        return $this->service->index();
    }

    public function lastStates(): \Illuminate\Support\Collection
    {
        return $this->service->getLatest();
    }

    /**
     * Show the form for creating a new resource
     *
     * @return Application|Factory|View
     */
    public function create(HeadingService $headingService)
    {
/*        return $headingService->getNames();*/
    }

    /**
     * Store a nuwky created resource in storage
     *
     * @param StateRequest $request
     * @return void
     */
    public function store(StateRequest $request): RedirectResponse
    {
        $this->service->store($request);
    }


    /**
     * Display the specified resource
     *
     * @param int $id
     * @return array
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param int $id
     * @param HeadingRepository $headingRepository
     * @return array
     */
    public function edit(int $id, HeadingRepository $headingRepository)
    {
        $state = $this->service->edit($id);
        $headings = $headingRepository->index();

        return ['state' => $state, 'headings' => $headings];
    }

    /**
     * Update the specified resource in storage
     *
     * @param StateEditRequest $request
     * @param int $id
     * @return void
     */
    public function update(StateEditRequest $request, int $id)
    {
        $this->service->update($request, $id);
    }

    public function archive()
    {
        return $this->service->archive();
    }

    /**
     * Remove the specified resource from storage
     *
     * @param int $id
     * @param CommentController $commentController
     * @return void
     */
    public function destroy(int $id, CommentController $commentController): RedirectResponse
    {
        $this->service->destroy($id, $commentController);
    }

    /**
     * recover the state resource from archive
     *
     * @param $id
     * @return void
     */
    public function recover($id): RedirectResponse
    {
        $this->service->recover($id);
    }
}
