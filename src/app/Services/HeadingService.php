<?php

namespace App\Services;

use App\Http\Requests\HeadingRequest;
use App\Models\Heading;
use App\Repositories\HeadingRepository;
use App\Repositories\StateRepository;

class HeadingService extends BaseService
{
    public function __construct(HeadingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(HeadingRequest $request)
    {
        $data = $request->except('_token');

        $data['image'] = $this->saveImage($request);

        Heading::create($data);
    }

    public function saveImage($request)
    {
        return $request->file('image')->store('images');
    }

    public function show(int $id)
    {
        $heading = (new HeadingRepository)->find($id);
        $heading->states = (new StateRepository)->getForHeading($id);


        return $heading;
    }
}
