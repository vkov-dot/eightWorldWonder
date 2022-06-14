<?php

namespace App\Services;

use App\Http\Requests\PhotoRequest;
use App\Repositories\MediaFolderRepository;
use App\Repositories\PhotoRepository;

class PhotoService
{
    private $repository;

    public function __construct(PhotoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getIndex(MediaFolderRepository $folderRepository)
    {
        return $this->repository->index($folderRepository);
    }

    public function store(PhotoRequest $request)
    {
        $this->repository->store($request);
    }
}
