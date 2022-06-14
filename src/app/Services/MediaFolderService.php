<?php

namespace App\Services;

use App\Http\Requests\MediaFolderRequest;
use App\Models\MediaFolder;
use App\Repositories\MediaFolderRepository;

class MediaFolderService extends BaseService
{
    public function __construct(MediaFolderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(MediaFolderRequest $request)
    {
        $data = $request->except('_token');
        MediaFolder::create($data);
    }

    public function show(int $id)
    {
        $medias = $this->repository->findNotes($id);
        $medias->folder = $this->repository->findFolder($id);

        return $medias;
    }
}
