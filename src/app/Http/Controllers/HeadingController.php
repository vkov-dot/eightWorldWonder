<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeadingRequest;
use App\Repositories\HeadingRepository;
use App\Repositories\StateRepository;

class HeadingController extends Controller
{
    private $repository;

    public function __construct(HeadingRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $headings = $this->repository->getIndex();

        return view('headings.index', ['headings' => $headings]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('headings.create');
    }

    /**
     * Store a newly created resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(HeadingRequest $request)
    {
        $this->repository->store($request);

        return redirect()->route('headings.index');
    }

    /**
     * Display the specified resource
     *
     * @param int $id
     * @param \Illuminate\Http\Response
     */
    public function show($id, StateRepository $stateRepository, HeadingRepository $headingRepository)
    {
        $states = $stateRepository->getForHeading($id);
        $heading = $headingRepository->find($id);

        return view('headings.show', [
            'states' => $states,
            'heading' => $heading
        ]);
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(HeadingRequest $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage
     *
     * @param int $id
     * @return int
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}

