<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Models\Video;
use App\Repositories\HeadingRepository;
use App\Repositories\MediaFolderPerository;
use App\Repositories\MediaFolderRepository;
use App\Repositories\VideoRepository;
use App\Services\VideoService;

class VideoController extends Controller
{
    private $service;

    public function __construct(VideoService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(MediaFolderRepository $mediaFolderRepository)
    {
        $mediaFolders = $this->service->index($mediaFolderRepository);

        return view('videos.create', [
            'mediaFolders' => $mediaFolders,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VideoRequest $request)
    {
        $this->service->store($request);

        return redirect()->route('videos.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video::query()->find($id)->delete();
    }
}
