<?php

namespace App\Repositories;

use App\Models\MediaFolder;

class MediaFolderPerository
{
    private function query()
    {
        return MediaFolder::query();
    }

    public function find($id)
    {
        return $this->query()->find($id);
    }

    public function findNotes($id, PhotoRepository $photoRepository, VideoRepository $videoRepository)
    {
        $photos = $photoRepository->getPhotosByFolder($id);
        $videos = $videoRepository->getVideosByFolder($id);
        $medias = $photos->merge($videos);
        $medias->sortByDesc('id');

        return $medias;
    }

    public function findFolder($id)
    {
        return $this->find($id);
    }

    public function store(\App\Http\Requests\MediaFolderRequest $request)
    {
        $data = $request->except('_token');

        return $this->query()->create($data);
    }

    public function getIndex()
    {
        return $this->query()
            ->orderBy('id', 'desc')
            ->get();
    }
}
