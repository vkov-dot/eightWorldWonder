<?php

namespace App\Repositories;

use App\Http\Requests\IssueRequest;
use App\Mail\IssuePublished;
use App\Models\Issue;
use http\Env\Request;
use Illuminate\Support\Facades\Mail;

class IssueRepository
{
    private function query()
    {
        return Issue::query();
    }

    public function find($id)
    {
        return $this->query()->find($id);
    }

    public function getIndex()
    {
        return $this->query()
            ->select('id', 'name', 'link', 'created_at')
            ->where('archived', 0)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function store(IssueRequest $request)
    {
        $data = $request->except('_token');
        Mail::to($request->user())->send(new IssuePublished($request));

        return $this->query()->create($data);
    }

    public function search($request)
    {
        return $this->query()
            ->select('id', 'name', 'link', 'created_at')
            ->where('name', 'LIKE', "%$request->param%")
            ->where('archived', 0)
            ->paginate(10);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->except('_token', '_method');
        $issue = $this->find($id);

        return $issue->update($data);
    }

    public function recover($id)
    {
        $issue = $this->find($id);
        $issue->archived = 0;

        return $issue->update();
    }

    public function getForStartPage()
    {
        return $this->query()
            ->select('id', 'name', 'link', 'created_at')
            ->orderBy('id', 'desc')
            ->where('archived', 0)
            ->take(5)
            ->get();
    }
}
