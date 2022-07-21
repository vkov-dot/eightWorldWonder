<?php

namespace App\Services;

use App\Http\Requests\HeadingRequest;
use App\Models\Heading;
use App\Repositories\HeadingRepository;
use App\Repositories\StateRepository;
use Carbon\Carbon;

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

    public function show($id)
    {
        $heading = (new HeadingRepository)->find($id);
        $heading->states = (new StateRepository)->getForHeadingId($id);
        foreach($heading->states as $state) {
            $state->published_at = Carbon::parse($state->created_at)->format('d.m.Y');
        }

        return $heading;
    }

    public function update(HeadingRequest $request)
    {
        $heading = $request->except('_token');
        if(asset($heading['image'])) {
            $heading['image'] = $this->saveImage($request);
        }

        Heading::find($request->id)->update($heading);
    }

    public function getNames()
    {
        return $this->repository->getNames();
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
    }
}
