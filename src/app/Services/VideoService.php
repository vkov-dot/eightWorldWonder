<?php

namespace App\Services;

use App\Http\Requests\VideoRequest;
use App\Repositories\MediaFolderRepository;
use App\Repositories\VideoRepository;
use http\Client\Request;

class VideoService
{
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getIndex(MediaFolderRepository $mediaFolderRepository)
    {
        return $mediaFolderRepository->index();
    }

    public function store(VideoRequest $request)
    {
        $this->repository->store($request);
    }
}
