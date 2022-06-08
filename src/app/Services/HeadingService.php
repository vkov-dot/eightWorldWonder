<?php

namespace App\Services;

use App\Http\Requests\HeadingRequest;
use App\Repositories\HeadingRepository;
use App\Repositories\StateRepository;

class HeadingService
{
    private $repository;

    public function __construct(HeadingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(HeadingRequest $request)
    {
        $this->repository->store($request);
    }

    public function show(int $id, StateRepository $stateRepository, HeadingRepository $headingRepository)
    {
        $states = $stateRepository->getForHeading($id);
        $states['heading'] = $headingRepository->find($id);

        return $states;
    }
}
