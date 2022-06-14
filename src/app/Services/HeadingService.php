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

    public function show(int $id)
    {
        $states = (new StateRepository)->getForHeading($id);
        $states['heading'] = (new HeadingRepository)->find($id);

        return $states;
    }
}
