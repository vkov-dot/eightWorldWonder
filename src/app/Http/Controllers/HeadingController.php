<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeadingRequest;
use App\Services\HeadingService;
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
        $headings = $this->service->index();

        return view('headings.index', ['headings' => $headings]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('headings.create');
    }

    /**
     * Store a newly created resource in storage
     *
     * @param HeadingRequest $request
     * @return RedirectResponse
     */
    public function store(HeadingRequest $request): RedirectResponse
    {
        $this->service->store($request);

        return redirect()->route('headings.index');
    }

    /**
     * Display the specified resource
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $heading = $this->service->show($id);

        return view('headings.show', [
            'heading' => $heading
        ]);
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $heading = $this->service->edit($id);

        return view('headings.edit', ['heading' => $heading]);
    }

    /**
     * Update the specified resource in storage
     *
     * @param HeadingRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(HeadingRequest $request, int $id): RedirectResponse
    {
        $this->service->update($request, $id);

        return redirect()->route('headings.index');
    }
}
