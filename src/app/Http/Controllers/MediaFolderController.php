<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaFolderRequest;
use App\Services\MediaFolderService;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewAlias;
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
     * @return ApplicationAlias|Factory|ViewAlias
     */
    public function create()
    {
        $mediaFolders = $this->service->index();

        return view('media.create', ['mediaFolders' => $mediaFolders]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MediaFolderRequest $request
     * @return void
     */
    public function store(MediaFolderRequest $request): RedirectResponse
    {
        $this->service->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ApplicationAlias|Factory|ViewAlias
     */
    public function show(int $id)
    {
        $mediaFolder = $this->service->show($id);

        return view('media.show', ['mediaFolder' => $mediaFolder]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->service->destroy($id);

        return redirect()->route('media.index');
    }
}
