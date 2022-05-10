<?php

namespace App\Repositories;

use App\Http\Requests\VideoRequest;
use App\Models\Video;

class VideoRepository
{
    private function query()
    {
        return Video::query();
    }

    private function find(int $id)
    {
        return $this->query()->find($id);
    }

    public function getVideosByFolder($id)
    {
        return $this->query()
            ->where('media_folder_id', $id)
            ->get();
    }

    public function getIndex()
    {
        return $this->query()
            ->orderBy('id', 'desc')
            ->get();
    }

    public function create(VideoRequest $request)
    {
        $data = $request->except('_token');

        $this->query()->create($data);
    }
}
