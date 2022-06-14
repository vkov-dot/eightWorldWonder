<?php

namespace App\Services;

use App\Http\Requests\VideoRequest;
use App\Models\Video;
use App\Repositories\MediaFolderRepository;
use App\Repositories\VideoRepository;

class VideoService extends BaseService
{
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return (new MediaFolderRepository)->index();
    }

    public function store(VideoRequest $request)
    {
        $data = $request->except('_token');

        Video::create($data);
    }
}
