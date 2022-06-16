<?php

namespace App\Services;

use App\Http\Requests\MediaFolderRequest;
use App\Models\MediaFolder;
use App\Models\Photo;
use App\Models\Video;
use App\Repositories\MediaFolderRepository;
use App\Repositories\PhotoRepository;
use App\Repositories\VideoRepository;

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
        $mediaFolder = $this->repository->findFolder($id);
        $mediaFolder->photos = (new PhotoRepository)->getPhotosByFolder($id);
        $mediaFolder->videos = (new VideoRepository)->getVideosByFolder($id);

        return $mediaFolder;
    }

    public function destroy(int $id)
    {
        Photo::where('media_folder_id', $id)->delete();
        Video::where('media_folder_id', $id)->delete();
        MediaFolder::find($id)->delete();
    }
}
