<?php

namespace App\Http\Controllers;

use App\Http\Requests\StateEditRequest;
use App\Http\Requests\StateRequest;
use App\Models\State;
use App\Repositories\CommentRepository;
use App\Repositories\HeadingRepository;
use App\Services\HeadingService;
use App\Services\StateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function index()
    {
        $states = $this->service->index();

        return view('states.index', ['states' =>$states]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(HeadingService $headingService)
    {
        $headings = $headingService->index();

        return view('states.create', ['headings' => $headings]);
    }

    /**
     * Store a nuwky created resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StateRequest $request): \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(int $id, CommentRepository $commentRepository)
    {
        $lastStates = $this->service->getLatest();
        $state = $this->service->show($id, $commentRepository);

        return view('states.show', [
            'state' => $state,
            'lastStates' =>$lastStates
        ]);
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id, HeadingRepository $headingRepository)
    {
        $state = $this->service->edit($id);
        $headings = $headingRepository->index();

        return view('states.edit', ['state' => $state, 'headings' => $headings]);
    }

    /**
     * Update the specified resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StateEditRequest $request, $id)
    {
        $this->service->update($request, $id);

        return redirect()->route('states.show', ['state' => $id]);
    }

    /**
     * Remove the specified resource from storage
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, CommentController $commentController)
    {
        $state = State::find($id);
        if($state->archived) {
            Storage::disk('public')->delete($state->logo);
            $commentController->destroyByStateId($id);
            $state->delete();
        }
        else {
            $state->archived = 1;
            $state->update();
        }

        return redirect()->route('states.index');
    }

    /**
     * recover the state resource from archive
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function recover($id): \Illuminate\Http\RedirectResponse
    {
        $this->service->recover($id);

        return redirect()->route('archived.show', ['table' => 'states']);
    }
}

