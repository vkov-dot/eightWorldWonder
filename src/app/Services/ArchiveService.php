<?php

namespace App\Services;

use App\Repositories\ArchiveRepository;

class ArchiveService
{
    private $repository;

    public function __construct(ArchiveRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show($tableName)
    {
        return $this->repository->show($tableName);
    }
}
