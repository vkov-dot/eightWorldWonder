<?php

namespace App\Services;

use App\Http\Requests\PhotoRequest;
use App\Repositories\MediaFolderRepository;
use App\Repositories\PhotoRepository;
use phpseclib3\Crypt\EC\BaseCurves\Base;

class PhotoService extends BaseService
{
    public function __construct(PhotoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(PhotoRequest $request)
    {
        $this->repository->store($request);
    }
}
