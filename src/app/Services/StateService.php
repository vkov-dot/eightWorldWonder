<?php

namespace App\Services;

use App\Http\Controllers\CommentController;
use App\Http\Requests\StateEditRequest;
use App\Models\Rating;
use App\Models\State;
use App\Repositories\CommentRepository;
use App\Repositories\RatingRepository;
use App\Repositories\StateRepository;
use App\Http\Requests\StateRequest;
use Illuminate\Support\Facades\Storage;

class StateService extends BaseService
{
    public function __construct(StateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getLatest()
    {
        return $this->repository->getLatest();
    }

    public function show($id)
    {
        $state = $this->find($id);
        $state['comments'] = (new CommentRepository)->getByStateId($id);
        $state['rating'] = (new RatingRepository)->getRatingByStateId($id);
        $state['ratingCount'] = (new RatingRepository)->getRatingCountByStateId($id);
        $state['rating'] = round($state['rating'], 2);

        return $state;
    }

    public function store(StateRequest $request)
    {
        $data = $request->except('_token');
        $data['logo'] = $this->saveImage($request);

        State::create($data);
    }

    public function update(StateEditRequest $request, int $id)
    {
        $data = $request->except('_token');
        $state = $this->find($id);

        if($request->logo) {
            $data['logo'] = $this->saveImage($request);
            Storage::disk('public')->delete($state->logo);
        }

        $state->update($data);
    }

    public function recover($id)
    {
        $state = $this->find($id);
        $state->archived = 0;
        $state->update();
    }

    public function destroy(int $id, CommentController $commentController)
    {
        $state = $this->find($id);
        if($state->archived) {
            Rating::where('state_id', $id)->delete();
            Storage::disk('public')->delete($state->logo);
            $commentController->destroyByStateId($id);
            $state->delete();
        }
        else {
            $state->archived = 1;
            $state->update();
        }
    }

    public function sort($request)
    {
        return $this->repository->sort($request);
    }
}
