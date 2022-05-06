<?php

namespace App\Repositories;

use App\Models\Issue;
use http\Env\Request;

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
            ->select('id', 'name', 'link')
            ->where('archived', 0)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function store($request)
    {
        $data = $request->except('_token');

        return $this->query()->create($data);
    }

    public function search($request)
    {
        return $this->query()
            ->select('id', 'name', 'link')
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

    public function destroy(int $id)
    {
        $issue = $this->find($id);
        if($issue['archived']) {
            $issue->delete();
        }
        else {
            $issue['archived'] = 1;
        }

        return $issue->update();
    }

    public function recover($id)
    {
        $issue = $this->find($id);
        $issue->archived = 0;

        return $issue->update();
    }
}
