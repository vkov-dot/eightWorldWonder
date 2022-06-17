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
        $states = $this->service->index();

        return view('states.index', ['states' =>$states]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return Application|Factory|View
     */
    public function create(HeadingService $headingService)
    {
        $headings = $headingService->index();

        return view('states.create', ['headings' => $headings]);
    }

    /**
     * Store a nuwky created resource in storage
     *
     * @param StateRequest $request
     * @return RedirectResponse
     */
    public function store(StateRequest $request): RedirectResponse
    {
        $this->service->store($request);

        return redirect()->route('states.index');
    }


    public function search(Request $request)
    {
        $states = $this->service->search($request);

        return view('states.index', [
            'states' => $states,
            'message' => $request->param
            ]);
    }

    /**
     * Display the specified resource
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $lastStates = $this->service->getLatest();
        $state = $this->service->show($id);

        return view('states.show', [
            'state' => $state,
            'lastStates' =>$lastStates
        ]);
    }

    public function sort(Request $request)
    {
        $states = $this->service->sort($request);

        return view('states.index', ['states' => $states]);
    }
    /**
     * Show the form for editing the specified resource
     *
     * @param int $id
     * @param HeadingRepository $headingRepository
     * @return Application|Factory|View
     */
    public function edit(int $id, HeadingRepository $headingRepository)
    {
        $state = $this->service->edit($id);
        $headings = $headingRepository->index();

        return view('states.edit', ['state' => $state, 'headings' => $headings]);
    }

    /**
     * Update the specified resource in storage
     *
     * @param StateEditRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(StateEditRequest $request, int $id)
    {
        $this->service->update($request, $id);

        return redirect()->route('states.show', ['state' => $id]);
    }

    /**
     * Remove the specified resource from storage
     *
     * @param int $id
     * @param CommentController $commentController
     * @return RedirectResponse
     */
    public function destroy(int $id, CommentController $commentController): RedirectResponse
    {
        $this->service->destroy($id, $commentController);

        return redirect()->route('states.index');
    }

    /**
     * recover the state resource from archive
     *
     * @param $id
     * @return RedirectResponse
     */
    public function recover($id): RedirectResponse
    {
        $this->service->recover($id);

        return redirect()->route('archived.show', ['table' => 'states']);
    }
}
