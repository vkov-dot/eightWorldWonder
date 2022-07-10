<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Services\CommentService;
use App\Services\StateService;
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
     * @return RedirectResponse
     */
    public function store(CommentRequest $request, int $id): RedirectResponse
    {
        $this->service->store($request, $id);

        return redirect()->route('states.show', ['state' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $stateId
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($stateId, int $id): RedirectResponse
    {
        $this->service->destroy($id);

        return redirect()->route('states.show', ['state' => $stateId]);
    }

    public function destroyByStateId(int $id)
    {
        $this->service->destroy($id);
    }
}
