<?php

namespace App\Http\Controllers;

use App\Http\Requests\StateEditRequest;
use App\Http\Requests\StateRequest;
use App\Models\Heading;
use App\Repositories\HeadingRepository;
use App\Repositories\StateRepository;
use Illuminate\Http\Request;

class StateController extends Controller
{
    private $repository;

    public function __construct(StateRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function index()
    {
        $states = $this->repository->getIndex();

        return view('states.index', ['states' =>$states]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $headings = Heading::all();

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
        $this->repository->store($request);

        return redirect()->route('states.index');
    }


    public function search(Request $request)
    {
        $states = $this->repository->getSearch($request);

        return view('states.index', ['states' => $states]);
    }

    /**
     * Display the specified resource
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $lastStates = $this->repository->getIndexLatest();
        $state = $this->repository->find($id);

        return view('states.show', ['state' => $state, 'lastStates' =>$lastStates]);
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = $this->repository->find($id);
        $headings = Heading::all();

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
        $this->repository->update($request, $id);

        return redirect()->route('states.show', ['state' => $id]);
    }

    /**
     * Remove the specified resource from storage
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);

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
        $this->repository->recover($id);

        return redirect()->route('archives.show', ['table' => 'states']);
    }
}

