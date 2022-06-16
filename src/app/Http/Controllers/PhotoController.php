<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Models\Photo;
use App\Services\MediaFolderService;
use App\Services\PhotoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PhotoController extends Controller
{
    private $service;

    public function __construct(PhotoService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(MediaFolderService $folderService)
    {
        $mediaFolders = $folderService->index();

        return view('photos.create', ['mediaFolders' => $mediaFolders]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PhotoRequest $request
     * @return RedirectResponse
     */
    public function store(PhotoRequest $request): RedirectResponse
    {
        $this->service->store($request);

        return redirect()->route('photos.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Photo::find($id)->delete();

        return back()->withInput();
    }
}
