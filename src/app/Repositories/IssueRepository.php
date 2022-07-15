<?php

namespace App\Repositories;

use App\Http\Requests\IssueRequest;
use App\Mail\IssuePublished;
use App\Models\Issue;
use http\Env\Request;
use Illuminate\Support\Facades\Mail;

class IssueRepository
{
    private function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Issue::query();
    }

    public function find($id)
    {
        return $this->query()->find($id);
    }

    public function index(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->query()
            ->where('archived', 0)
            ->latest()
            ->paginate(10, ['id', 'name', 'link', 'created_at']);
    }

    public function store(IssueRequest $request)
    {
        $data = $request->except('_token');
        $issue = $this->query()->create($data);
        $issue = $this->find($issue->id);

        return $issue;
    }

    public function search($request): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->query()
            ->where('name', 'LIKE', "%$request->param%")
            ->where('archived', 0)
            ->paginate(10, ['id', 'name', 'link', 'created_at']);
    }

    public function getLatest()
    {
        return $this->query()
            ->latest()
            ->where('archived', 0)
            ->take(5)
            ->get(['id', 'name', 'link', 'created_at']);
    }

    public function archive()
    {
        return $this->query()->where('archived', 1)->get();
    }
}
