<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueRequest;
use App\Mail\IssuePublished;
use App\Models\Issue;
use App\Services\CategoryService;
use App\Services\IssueService;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\IssueRepository;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $issues = $this->service->index();

        return view('issues.index', ['issues' => $issues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(CategoryRepository $categoryRepository)
    {
        $categories = $this->service->getAll($categoryRepository);

        return view('issues.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(IssueRequest $request)
    {
        $this->service->store($request);

        return redirect()->route('issues.index');
    }

    public function search(Request $request)
    {
        $issues = $this->service->search($request);

        return view('issues.index', ['issues' => $issues]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $issue = $this->service->find($id);

        return view('issues.edit', ['issue' => $issue]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(IssueRequest $request, $id)
    {
        $this->service->update($request, $id);

        return redirect()->route('issues.show', ['issue' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $issue = Issue::query()->find($id);
        if($issue['archived']) {
            $issue->delete();
        }
        else {
            $issue['archived'] = 1;
            $issue->update();
        }

        return redirect()->route('issues.index');
    }

    /**
     * recover the issue resource from archive
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function recover($id)
    {
        $this->service->recover($id);

        return redirect()->route('archived.show', ['table' => 'issues']);
    }
}
