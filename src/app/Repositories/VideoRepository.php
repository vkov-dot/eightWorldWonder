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

    public function getVideosByFolder($id)
    {
        return $this->query()
            ->where('media_folder_id', $id)
            ->get();
    }
}
