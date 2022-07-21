<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Services\CommentService;
use App\Services\StateService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    private $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @param int $id
     * @return Builder|\Illuminate\Database\Eloquent\Model|RedirectResponse|object|void
     */
    public function store(CommentRequest $request, int $id)
    {
        return $this->service->store($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $stateId
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($stateId, int $id): \Illuminate\Http\JsonResponse
    {
        $this->service->destroy($id);

        return response()->json(['message' => 'success']);
    }

    public function destroyByStateId(int $id)
    {
        $this->service->destroyByStateId($id);

        return response()->json(['message' => 'success']);
    }
}
