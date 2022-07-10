<?php

namespace App\Services;

use App\Http\Requests\IssueRequest;
use App\Jobs\IssuePublishedJob;
use App\Mail\IssuePublished;
use App\Models\Issue;
use App\Repositories\CategoryRepository;
use App\Repositories\IssueRepository;
use Carbon\Carbon;
use http\Client\Request;
use Illuminate\Support\Facades\Mail;
use phpseclib3\Crypt\EC\BaseCurves\Base;

class IssueService extends BaseService
{
    public function __construct(IssueRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(CategoryRepository $categoryRepository)
    {
        return $categoryRepository->getAll();
    }

    public function store(IssueRequest $request)
    {
        $issue = $this->repository->store($request);
        IssuePublishedJob::dispatch($issue);
    }

    public function getLatest()
    {
        $issues = $this->repository->getLatest();
        foreach($issues as $issue) {
            $issue->published_at = Carbon::parse($issue->created_at)->format('d.m.Y');
        }

        return $issues;
    }
    public function update($request, int $id)
    {
        $data = $request->except('_token');
        $issue = $this->find($id);

        $issue->update($data);
    }

    public function recover($id)
    {
        $issue = $this->find($id);
        $issue->archived = 0;

        $issue->update();
    }

    public function destroy(int $id)
    {
        $issue = $this->find($id);
        if($issue['archived']) {
            $issue->delete();
        }
        else {
            $issue['archived'] = 1;
            $issue->update();
        }
    }
}
