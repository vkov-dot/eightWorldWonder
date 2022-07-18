<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueRequest;
use App\Services\IssueService;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;

class IssueController extends Controller
{
    private $service;

    public function __construct(IssueService $service)
    {
        $this->service= $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ApplicationAlias|Factory|View
     */
    public function index()
    {
        return $this->service->index();
    }

    public function lastFive()
    {
        return $this->service->getLatest();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function create(CategoryRepository $categoryRepository)
    {
        return $this->service->getAll($categoryRepository);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param IssueRequest $request
     * @return void
     */
    public function store(IssueRequest $request): string
    {
        $this->service->store($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param IssueRequest $request
     * @param int $id
     * @return void
     */
    public function update(IssueRequest $request, int $id): RedirectResponse
    {
        $this->service->update($request, $id);
    }

    public function archive()
    {
        return $this->service->archive();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->service->destroy($id);
    }

    /**
     * recover the issue resource from archive
     *
     * @param $id
     * @return void
     */
    public function recover($id): RedirectResponse
    {
        $this->service->recover($id);
    }
}
