<?php

namespace App\Services;

use App\Http\Requests\MediaFolderRequest;
use App\Models\MediaFolder;
use App\Models\Photo;
use App\Models\Video;
use App\Repositories\MediaFolderRepository;
use App\Repositories\PhotoRepository;
use App\Repositories\VideoRepository;
use Carbon\Carbon;

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

    public function show($id)
    {
        return $this->repository->findFolder($id);
    }

    public function update(MediaFolderRequest $request)
    {
        $folder = $this->find($request->id);
        $folder->link = $request->link;
        $folder->name = $request->name;
        $folder->update();
    }

    public function destroy(int $id)
    {
        MediaFolder::find($id)->delete();
    }
}
