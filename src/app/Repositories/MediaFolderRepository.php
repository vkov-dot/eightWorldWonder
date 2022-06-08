<?php

namespace App\Repositories;

use App\Http\Requests\MediaFolderRequest;
use App\Models\MediaFolder;

class MediaFolderRepository
{
    private function query()
    {
        return MediaFolder::query();
    }

    public function find($id)
    {
        return $this->query()->find($id);
    }

    public function findNotes($id)
    {
        $photos = (new PhotoRepository)->getPhotosByFolder($id);
        $videos = (new VideoRepository)->getVideosByFolder($id);
        $medias = $photos->merge($videos);
        $medias->sortByDesc('id');

        return $medias;
    }

    public function findFolder($id)
    {
        return $this->find($id);
    }

    public function store(MediaFolderRequest $request)
    {
        $data = $request->except('_token');

        $this->query()->create($data);
    }

    public function index()
    {
        return $this->query()
            ->latest()
            ->get();
    }
}
