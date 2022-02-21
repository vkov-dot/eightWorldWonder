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
        foreach ($mediaFolders as $media) {
            $media->date = Carbon::parse($media->created_at)->format('d.m.Y');
        }
        return view('media.index', ['mediaFolders' => $mediaFolders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        foreach ($medias as $media) {
            $media->date = Carbon::parse($media->created_at)->format('d.m.Y');
        }
        $mediaFolder = MediaFolder::find($id);

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
