<?php

namespace App\Services;

use App\Repositories\ArchiveRepository;

class ArchiveService extends BaseService
{
    public function __construct(ArchiveRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show($tableName)
    {
        return $this->repository->show($tableName);
    }
}
