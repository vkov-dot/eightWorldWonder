<?php

namespace App\Repositories;

use App\Http\Requests\MediaFolderRequest;
use App\Models\MediaFolder;

class MediaFolderRepository
{
    private function query()
    {
        return MediaFolder::query();
    }

    public function find($id)
    {
        return $this->query()->find($id);
    }

    public function findFolder($id)
    {
        return $this->find($id);
    }

    public function index()
    {
        return collect($this->query()->latest()->get());
    }
}
