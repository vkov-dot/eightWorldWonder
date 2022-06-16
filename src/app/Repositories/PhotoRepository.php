<?php

namespace App\Repositories;

use App\Http\Requests\PhotoRequest;
use App\Models\Photo;

class PhotoRepository
{
    private function query()
    {
        return Photo::query();
    }

    public function find($id)
    {
        return $this->query()->find($id);
    }
    public function getPhotosByFolder($id)
    {
        return $this->query()
            ->where('media_folder_id', $id)
            ->get();
    }

    public function index()
    {
        return $this->query()
            ->latest()
            ->get();
    }

    public function store(PhotoRequest $request)
    {
        $data = $request->except('_token');

        $this->query()->create($data);
    }
}
