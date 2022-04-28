<?php

namespace App\Http\Controllers;

use App\Models\MediaFolder;
use App\Models\Photo;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MediaFolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $mediaFolders = MediaFolder::orderBy('id', 'desc')->get();

        return view('media.index', ['mediaFolders' => $mediaFolders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $mediaFolders = MediaFolder::all();

        return view('media.create', ['mediaFolders' => $mediaFolders]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        MediaFolder::create($data);

        return redirect()->route('media.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $photos = Photo::where('media_folder_id', $id)->get();
        $videos = Video::where('media_folder_id', $id)->get();
        $medias = $photos->merge($videos);
        $medias->sortByDesc('id');
        $mediaFolder = MediaFolder::find($id);

        //dd($medias);

        return view('media.show', [
            'medias' => $medias,
            'mediaFolder' => $mediaFolder
        ]);
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
    public function update(Request $request, $id)
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
        //
    }
}
