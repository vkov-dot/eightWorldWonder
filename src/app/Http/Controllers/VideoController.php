<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Models\Video;
use App\Services\VideoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class VideoController extends Controller
{
    private $service;

    public function __construct(VideoService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $mediaFolders = $this->service->index();

        return view('videos.create', [
            'mediaFolders' => $mediaFolders,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VideoRequest $request
     * @return RedirectResponse
     */
    public function store(VideoRequest $request): RedirectResponse
    {
        $this->service->store($request);

        return redirect()->route('videos.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        Video::findOrFail($id)->delete();

        return back()->withInput();
    }
}
